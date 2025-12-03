<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi sederhana (opsional tapi sebaiknya ada)
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        // Buat user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // Generate token Sanctum
        $token = $user->createToken('api')->plainTextToken;

        return [
            'success' => true,
            'data' => [
                'user'  => $user,
                'token' => $token
            ]
        ];
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $request->user()->createToken('api')->plainTextToken;

        return [
            'success' => true,
            'token' => $token
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return [
            'success' => true,
            'message' => 'Logged out'
        ];
    }
}
