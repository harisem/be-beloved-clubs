<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->with('warehouses')->paginate(10);
        // dd($products);
        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouses = Warehouse::where('product_id', null)->get();

        return view('products.create', [
            'warehouses' => $warehouses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:products|max:64',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'products' => 'required',
            'content' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'discount' => 'required',
        ]);

        $image = $request->file('image');
        $imgName = $image->hashName();

        $stock = 0;
        foreach ($request->products as $product) {
            $warehouse = Warehouse::find($product);
            $stock += $warehouse->ready;
        };

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'image' => $imgName,
            'content' => $request->content,
            'weight' => $request->weight,
            'price' => $request->price,
            'stock' => $stock,
            'discount' => $request->discount,
        ]);

        if ($product) {
            foreach ($request->products as $productIds) {
                $warehouse = Warehouse::findOrFail($productIds);
                $warehouse->products()->associate($product);
                $warehouse->save();
            };

            $image->storeAs('public/products', $imgName);
            return redirect()->route('products.index')->with(['success', 'You have been added new product.']);
        } else {
            return redirect()->route('products.index')->with(['error', 'Some error occurred']);
        }
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
        $product = Product::with('warehouses')->where('id', $id)->first();
        $readyStock = $product->warehouses->sum('ready');
        // dd($product);

        return view('products.edit', [
            'product' => $product,
            'ready' => $readyStock,
        ]);
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
        $product = Product::find($id);

        $this->validate($request, [
            'name' => 'required|string|max:64|unique:products,name,' . $product->id,
            'content' => 'required',
            'ready' => 'required',
        ]);

        if ($request->file('image') == null) {
            // There is no image to update
            $product->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'content' => $request->content,
                'stock' => $request->ready,
            ]);
        } else {
            // There is image to update
            Storage::delete('public/products/' . basename($product->image));
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('public/products', $imageName);

            $product->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'image' => $imageName,
                'content' => $request->content,
                'stock' => $request->ready,
            ]);
        }

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $image1 = Storage::disk('local')->delete('public/products/' . $product->frontImage);
        $image2 = Storage::disk('local')->delete('public/products/' . $product->backImage);
        $product->delete();

        return redirect(route('products.index'));
    }
}
