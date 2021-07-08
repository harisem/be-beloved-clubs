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
        $products = Product::latest()->paginate(10);
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
        return view('products.create');
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
            'frontImage' => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'backImage' => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'content' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'discount' => 'required',
        ]);

        $image1 = $request->file('frontImage');
        $image2 = $request->file('backImage');
        
        $image1->storeAs('public/products', $image1->hashName());
        $image2->storeAs('public/products', $image2->hashName());

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'frontImage' => $image1->hashName(),
            'backImage' => $image2->hashName(),
            'content' => $request->content,
            'weight' => $request->weight,
            'price' => $request->price,
            'discount' => $request->discount,
        ]);

        if ($product) {
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
        $product = Warehouse::find($id);
        return view('products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:products|max:64',
            'frontImage' => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'backImage' => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'content' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'discount' => 'required',
        ]);

        if ($request->file('frontImage') === '') {

            if ($request->file('backImage') === '') {
                // There is no frontImage and backImage to update
                $product = Product::findOrFail($product->id);
                $product->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name, '-'),
                    'content' => $request->content,
                    'weight' => $request->weight,
                    'price' => $request->price,
                    'discount' => $request->discount,
                ]);
            } else {
                // There is no frontImage but has backImage to be update
                Storage::disk('local')->delete('public/products/' . $product->backImage);
                $image2 = $request->file('backImage');
                $image2->storeAs('public/products', $image2->hashName());

                $product = Product::findOrFail($product->id);
                $product->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name, '-'),
                    'backImage' => $image2->hashName(),
                    'content' => $request->content,
                    'weight' => $request->weight,
                    'price' => $request->price,
                    'discount' => $request->discount,
                ]);
            }

        } else {
            
            if ($request->file('backImage') === '') {
                // There is frontImage but no backImage to be update
                Storage::disk('local')->delete('public/products/' . $product->frontImage);
                $image1 = $request->file('frontImage');
                $image1->storeAs('public/products', $image1->hashName());

                $product = Product::findOrFail($product->id);
                $product->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name, '-'),
                    'frontImage' => $image1->hashName(),
                    'content' => $request->content,
                    'weight' => $request->weight,
                    'price' => $request->price,
                    'discount' => $request->discount,
                ]);
            } else {
                // There is frontImage and backImage to be update
                Storage::disk('local')->delete('public/products/' . $product->frontImage);
                Storage::disk('local')->delete('public/products/' . $product->backImage);

                $image1 = $request->file('frontImage');
                $image2 = $request->file('backImage');
                
                $image1->storeAs('public/products', $image1->hashName());
                $image2->storeAs('public/products', $image2->hashName());

                $product = Product::findOrFail($product->id);
                $product->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name, '-'),
                    'frontImage' => $image1->hashName(),
                    'backImage' => $image2->hashName(),
                    'content' => $request->content,
                    'weight' => $request->weight,
                    'price' => $request->price,
                    'discount' => $request->discount,
                ]);
            }
        }
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
