<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Photoshoot;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = Catalog::latest()->paginate(5);
        return view('catalogs.index', [
            'catalogs' => $catalogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('catalogs.create', [
            'products' => $products
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
            'name' => 'required|string|unique:catalogs|max:64',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2000',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/catalogs', $image->hashName());

        $catalog = Catalog::create([
            'name' => $request->name,
            'content' => $request->content,
            'image' => $image->hashName(),
            'slug' => Str::slug($request->name)
        ]);

        if ($catalog) {

            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $image) {
                    $image->storeAs('public/photoshoots', $image->hashName());
                    $catalog->photoshoots()->create([
                        'image' => $image->hashName()
                    ]);
                }
            }

            $product = Product::find($request->productId);
            $product->catalogs()->associate($catalog);
            // $product->save();

            return redirect()->route('catalogs.index')->with(['success', 'You have been created a new catalog.']);
        } else {
            return redirect()->route('catalogs.index')->with(['error', 'Some error occurred']);
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
        $catalog = Catalog::with(['photoshoots', 'products'])->find($id);
        return view('catalogs.edit', [
            'catalog' => $catalog
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
        $catalog = Catalog::with('photoshoot:image')->findOrFail($id);
        $images = $catalog->photoshoots;
        foreach ($images as $image) {
            Storage::disk('local')->delete('public/photoshoots/' . $image);
        }
        $deleted = Catalog::destroy($id);

        if ($deleted) {
            return redirect()->route('catalogs.index')->with(['success', 'You have been deleted the catalog.']);
        } else {
            return redirect()->route('catalogs.index')->with(['error', 'Some error occurred']);
        }
    }
}
