<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($user) {
            return response()->json([
                'message' => 'User\'s created successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Some error occurred.'
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        
        if (!auth('customers')->attempt($login)) {
            return response()->json([
                'message' => 'Invalid login credentials.'
            ], 401);
        }

        $user = auth('customers')->user();
        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json([
            'user' => $user,
            'token' => $accessToken
        ], 200);
    }

    public function profile(Request $request)
    {
        if ($request->user()) {
            return response()->json($request->user(), 200);
        }

        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'You have been logged out.'
        ], 200);
    }
}
