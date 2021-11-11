<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();

        return response()->json([
            'message' => 'Fetched successfully',
            'data' => $sliders,
            'success' => true
        ], 200);
    }
}
