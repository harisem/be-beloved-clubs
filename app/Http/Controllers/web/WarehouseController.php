<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::paginate(10);
        return view('warehouses.index', [
            'warehouses' => $warehouses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->size);
        $this->validate($request, [
            'name' => 'required|string|max:64',
            'size' => 'required',
            'color' => 'required',
            'frontImg' => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'backImg' => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'weight' => 'required|numeric',
            'stock' => 'nullable',
        ]);

        $image1 = $request->file('frontImg');
        $imgName1 = $image1->hashName();
        $image2 = $request->file('backImg');
        $imgName2 = $image2->hashName();

        $sizes = $request->size;
        $stock = explode(',', $request->stock);

        foreach ($sizes as $key => $size) {
            $warehouse = Warehouse::create([
                'name' => $request->name . ' - ' . Str::ucfirst($request->color) . ' - ' . Str::of($size)->upper(),
                'size' => Str::of($size)->upper(),
                'color' => $request->color,
                'frontImg' => $imgName1,
                'backImg' => $imgName2,
                'weight' => $request->weight,
                'ready' => $stock[$key],
            ]);
        }


        if ($warehouse) {
            $image1->storeAs('public/warehouses', $imgName1);
            $image2->storeAs('public/warehouses', $imgName2);
            return redirect()->route('warehouses.index')->with(['success', 'You have been addded a new product']);
        } else {
            return redirect()->route('warehouses.index')->with(['error', 'Some error occurred']);
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
        $warehouse = Warehouse::find($id);

        return view('warehouses.edit', [
            'warehouse' => $warehouse
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
        $product = Warehouse::findOrFail($id);
        $updated = $product->update($request->all());

        if ($updated) {
            return redirect()->route('warehouses.index')->with(['success', 'You have been edited the product.']);
        } else {
            return redirect()->route('warehouses.index')->with(['error', 'Some error occurred']);
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
        $delete = Warehouse::destroy($id);

        if ($delete) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
