<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;

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
        $this->validate($request, [
            'name' => 'required',
            'weight' => 'required|numeric',
            'production' => 'nullable|numeric',
            'ready' => 'nullable|numeric',
            'delivered' => 'nullable|numeric',
        ]);

        $product = Warehouse::create([
            'name' => $request->name,
            'weight' => $request->weight,
            'production' => $request->production,
            'ready' => $request->ready,
            'delivered' => $request->delivered,
        ]);

        if ($product) {
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
