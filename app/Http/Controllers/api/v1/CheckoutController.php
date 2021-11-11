<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware('auth:api')->except('notificationHandler');
        $this->request = $request;
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function store()
    {
        DB::transaction(function () {
            $length = 10;
            $random = '';

            for ($i=0; $i < $length; $i++) { 
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }

            $invoiceNumber = 'INV-BC-' . Str::upper($random);

            $invoice = new Invoice([
                'invoice' => $invoiceNumber,
                'courier' => $this->request->courier,
                'service' => $this->request->service,
                'cost_courier' => $this->request->cost,
                'weight' => $this->request->weight,
                'name' => $this->request->name,
                'phone' => $this->request->phone,
                'province' => $this->request->province,
                'city' => $this->request->city,
                'address' => $this->request->address,
                'grand_total' => $this->request->grand_total,
                'status' => 'pending'
            ]);

            $customer = Customer::find(auth('api')->user()->id);
            $invoice->customers()->associate($customer);
            $invoice->save();

            foreach (Cart::where('customer_id', auth('api')->user()->id)->get() as $cart) {
                $order = new Order([
                    'image' => $cart->product->frontImg,
                    'quantity' => $cart->quantity,
                    'price' => $cart->price,
                    'status' => 'pending'
                ]);
                $product = Product::find($cart->product_id);

                $order->invoices()->associate($invoice);
                $order->products()->associate($product);
                $order->save();
            }

            $payload = [
                'transaction_detail' => [
                    'order_id' => $invoice->invoice,
                    'gross_amount' => $invoice->grand_total
                ],

                'customer_details' => [
                    'first_name' => $invoice->name,
                    'email' => auth('api')->user()->email,
                    'phone' => $invoice->phone,
                    'shipping_address' => $invoice->address
                ]
            ];

            $snapToken = Snap::getSnapToken($payload);
            $invoice->snap_token = $snapToken;
            $invoice->save();
            $this->response['snap_token'] = $snapToken;
        });

        return response()->json([
            'message' => 'Order successfully.',
            'success' => true,
            $this->response
        ]);
    }

    public function notificationHandler(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);

        $signatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . config('services.midtrans.serverKey'));

        if ($notification->signature_key != $signatureKey) {
            return response([
                'message' => 'Invalid signature'
            ], 403);
        }

        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraud = $notification->fraud_status;

        $invoice = Invoice::where('invoice', $orderId)->first();
        $orders = Order::where('invoice_id', $invoice->id)->get();

        if ($transaction === 'capture') {
            if ($type === 'credit_card') {
                if ($fraud === 'challenge') {
                    $invoice->update([
                        'status' => 'pending'
                    ]);
                } else {
                    $invoice->update([
                        'status' => 'success'
                    ]);
                    
                    foreach ($orders as $order) {
                        $order->update([
                            'status' => 'paid'
                        ]);
                    }
                }
            }
        } elseif ($transaction === 'settlement') {
            $invoice->update([
                'status' => 'success'
            ]);
            
            foreach ($orders as $order) {
                $order->update([
                    'status' => 'paid'
                ]);
            }
        } elseif ($transaction === 'pending') {
            $invoice->update([
                'status' => 'pending'
            ]);
        } elseif ($transaction === 'deny') {
            $invoice->update([
                'status' => 'failed'
            ]);
            
            foreach ($orders as $order) {
                $order->update([
                    'status' => 'cancelled'
                ]);
            }
        } elseif ($transaction === 'expire') {
            $invoice->update([
                'status' => 'expired'
            ]);
            
            foreach ($orders as $order) {
                $order->update([
                    'status' => 'cancelled'
                ]);
            }
        } elseif ($transaction === 'cancel') {
            $invoice->update([
                'status' => 'failed'
            ]);
            
            foreach ($orders as $order) {
                $order->update([
                    'status' => 'cancelled'
                ]);
            }
        }
    }
}
