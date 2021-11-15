<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Slider;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->paginate(5);
        return view('sliders.index', [
            'sliders' => $sliders
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
            'title' => 'required|string',
            'bg' => 'required|string',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2000',
        ]);

        $image = $request->file('image');
        $imageName = $image->hashName();
        
        $slider = Slider::create([
            'image' => $imageName,
            'title' => $request->title,
            'description' => $request->description,
            'bg' => Str::substr($request->bg, 1),
        ]);
        
        if ($slider) {
            $image->storeAs('public/sliders', $imageName);
            return redirect()->route('sliders.index')->with([
                'success' => 'Sliders have been saved.'
            ]);
        } else {
            return redirect()->route('sliders.index')->with([
                'error' => 'Some error occurred.'
            ]);
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
        $slider = Slider::findOrFail($id);
        $image = Storage::disk('local')->delete('public/sliders/' . $slider->image);
        $slider->delete();

        if ($slider) {
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
