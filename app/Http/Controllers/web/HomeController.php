<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['invoices', 'warehouses.products:id,name,image'])->get();
        // $invoices = Invoice::orderBy('status', 'asc')->take(5)->get();
        $invoices = Invoice::where('status', 'success')->orderBy('created_at', 'asc')->take(5)->get();
        $best = $orders->whereIn('status', ['done', 'paid'])->groupBy('warehouse_id')->values();

        $bestProduct = [];
        for ($i=0; $i < count($best); $i++) { 
            $bestProduct[] = [
                'image' => $best[$i][0]->warehouses->products->image,
                'name' => $best[$i][0]->warehouses->products->name,
                'count' => $best[$i]->sum('quantity')
                // 'count' => count($best[$i])
            ];
        }

        $totalSells = [];
        for ($month = 1; $month <= 12; $month++) { 
            $date = Carbon::create(date('Y'), $month);
            $dateEnd = $date->copy()->endOfMonth();
            $transactions = Order::whereIn('status', ['paid', 'done'])
                                    ->where('created_at', '>=', $date)
                                    ->where('created_at', '<=', $dateEnd)
                                    ->sum('quantity');
            $totalSells[] = (int) $transactions;
        }

        // dd($orders->where('status', 'paid'));

        $data = [
            'pending' => $orders->where('status', 'pending'),
            'paid' => $orders->where('status', 'paid'),
            'completed' => $orders->where('status', 'done'),
            'cancelled' => $orders->where('status', 'cancelled'),
            'balance' => $orders->where('status', 'done')->sum('price'),
            'invoices' => $invoices,
            'bestProduct' => $bestProduct
        ];

        return view('index', [
            'data' => $data,
            'totalSells' => $totalSells
        ]);
    }

    /**
     * Display a report.
     *
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        $orders = Order::latest()->with(['invoices', 'warehouses.products:id,name,image'])->where('status', 'done')->paginate(10);

        return view('report.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
