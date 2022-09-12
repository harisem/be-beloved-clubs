<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->middleware('auth:api');
        $this->user = auth('api')->user();
        $this->profileService = $profileService;
    }

    public function index()
    {
        $data = $this->profileService->find($this->user->id);
        return $data;
    }

    public function update(Request $request)
    {
        $data = $this->profileService->toUpdate($request->all(), $this->user->id);
        return $data;
    }
}
