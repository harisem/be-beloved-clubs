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
        $products = Product::where('catalog_id', null)->get();
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
            'img' => 'required|image|mimes:jpeg,jpg,png|max:2000',
        ]);

        $img = $request->file('img');
        $img->storeAs('public/catalogs', $img->hashName());

        $catalog = Catalog::create([
            'name' => $request->name,
            'content' => $request->content,
            'image' => $img->hashName(),
            'slug' => Str::slug($request->name, '-')
        ]);

        if ($catalog) {

            if ($request->hasFile('photoshoots')) {
                $photoshoots = $request->file('photoshoots');
                $paths = [];
                foreach ($photoshoots as $photoshoot) {
                    $fileName = $photoshoot->hashName();
                    $paths[] = $photoshoot->storeAs('public/photoshoots', $fileName);
                    $catalog->photoshoots()->create([
                        'image' => $fileName
                    ]);
                }
            }

            $products = $request->products;
            foreach ($products as $productId) {
                $product = Product::find($productId);
                $product->catalogs()->associate($catalog);
                $product->save();
            }

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
        // $products = Product::where('catalog_id', null)->get();
        $products = Product::all();
        // dd($catalog);
        return view('catalogs.edit', [
            'catalog' => $catalog,
            'products' => $products
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
        $catalog = Catalog::with(['photoshoots', 'products'])->where('id', $id)->first();

        foreach ($catalog->photoshoots as $key => $value) {
            dd($value->image);
        }
        dd($catalog->photoshoots->image);

        $this->validate($request, [
            'products' => 'required',
            'name' => 'required|string',
            'content' => 'required',
        ]);

        if ($request->img == null) {
            // There is no image/jumbotron to update
            if ($request->photoshoots == null) {
                // Neither the image/jumbotron nor the photoshoots are going to update
                $updated = $catalog->update([
                    'name' => $request->name,
                    'content' => $request->content,
                    'slug' => Str::slug($request->name, '-')
                ]);

                if ($updated) {
                    $products = $request->products;
                    foreach ($products as $productId) {
                        $product = Product::find($productId);
                        $product->catalogs()->associate($catalog);
                        $product->save();
                    }

                    return redirect()->route('catalogs.index')->with(['success', 'You have been successfully edited the catalog.']);
                } else {
                    return redirect()->route('catalogs.index')->with(['error', 'Some error occurred']);
                }

            } else {
                // There is no image/jumbotron, but photoshoots to update
                $photoshoots = $catalog->photoshoots;
                foreach ($photoshoots as $photoshoot ) {
                    $fileName = Str::substr($photoshoot->image, 42);
                    Storage::disk('local')->delete('public/photoshoots/' . $fileName);
                    $photoshoot->delete();
                }

                $updated = $catalog->update([
                    'name' => $request->name,
                    'content' => $request->content,
                    'slug' => Str::slug($request->name, '-')
                ]);

                if ($updated) {
                    $products = $request->products;
                    foreach ($products as $productId) {
                        $product = Product::find($productId);
                        $product->catalogs()->associate($catalog);
                        $product->save();
                    }
                    
                    $files = $request->file('photoshoots');
                    foreach ($files as $file) {
                        $fileName = $file->hashName();
                        $file->storeAs('public/photoshoots', $fileName);
                        $catalog->photoshoots()->create([
                            'image' => $fileName
                        ]);
                    }

                    return redirect()->route('catalogs.index')->with(['success', 'You have been successfully edited the catalog.']);
                } else {
                    return redirect()->route('catalogs.index')->with(['error', 'Some error occurred']);
                }
            }
        } else {
            // There is image/jumbotron to update
            if ($request->photoshoots == null) {
                // There is image/jumbotron, but not the photoshoots to update
                Storage::disk('local')->delete('public/catalogs/' . $catalog->image);

                $file = $request->file('img');
                $fileName = $file->hashName();
                $file->storeAs('public/catalogs', $fileName);

                $updated = $catalog->update([
                    'name' => $request->name,
                    'content' => $request->content,
                    'image' => $fileName,
                    'slug' => Str::slug($request->name, '-')
                ]);

                if ($updated) {
                    $products = $request->products;
                    foreach ($products as $productId) {
                        $product = Product::find($productId);
                        $product->catalogs()->associate($catalog);
                        $product->save();
                    }

                    return redirect()->route('catalogs.index')->with(['success', 'You have been successfully edited the catalog.']);
                } else {
                    return redirect()->route('catalogs.index')->with(['error', 'Some error occurred']);
                }

            } else {
                // Both image/jumbotron and photoshoots are going update
                Storage::disk('local')->delete('public/catalogs/' . $catalog->image);

                $photoshoots = $catalog->photoshoots;
                foreach ($photoshoots as $photoshoot ) {
                    $fileName = Str::substr($photoshoot->image, 42);
                    Storage::disk('local')->delete('public/photoshoots/' . $fileName);
                    $photoshoot->delete();
                }

                $img = $request->file('img');
                $imgName = $img->hashName();

                $img->storeAs('public/catalogs', $imgName);
                $updated = $catalog->update([
                    'name' => $request->name,
                    'content' => $request->content,
                    'image' => $imgName,
                    'slug' => Str::slug($request->name, '-')
                ]);

                if ($updated) {
                    $products = $request->products;
                    foreach ($products as $productId) {
                        $product = Product::find($productId);
                        $product->catalogs()->associate($catalog);
                        $product->save();
                    }
                    
                    $files = $request->file('photoshoots');
                    foreach ($files as $file) {
                        $fileName = $file->hashName();
                        $file->storeAs('public/photoshoots', $fileName);
                        $catalog->photoshoots()->create([
                            'image' => $fileName
                        ]);
                    }

                    return redirect()->route('catalogs.index')->with(['success', 'You have been successfully edited the catalog.']);
                } else {
                    return redirect()->route('catalogs.index')->with(['error', 'Some error occurred']);
                }
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
        $catalog = Catalog::with(['photoshoots', 'products'])->findOrFail($id);
        // dd($catalog->photoshoots);
        $products = $catalog->products;

        $images = $catalog->photoshoots;
        foreach ($images as $image) {
            Storage::disk('local')->delete('public/photoshoots/' . $image->image);
        }
        foreach ($products as $product) {
            $product->catalogs()->dissociate($catalog);
            $product->save();
        }

        Storage::disk('local')->delete('public/catalogs/' . $catalog->image);
        $deleted = Catalog::destroy($id);

        if ($deleted) {
            return redirect()->route('catalogs.index')->with(['success', 'You have been deleted the catalog.']);
        } else {
            return redirect()->route('catalogs.index')->with(['error', 'Some error occurred']);
        }
    }
}
