<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email Kosong!',
            'password.required' => 'Password Kosong!'
        ]);

        if($validator->fails()){
            return response()->json([
                'http_code' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'http_code' => 401,
                    'errors' => 'Pengguna Tidak Ditemukan!'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'http_code' => 500,
                'errors' => 'Could not create token'
            ], 500);
        }

        return response()->json([
            'http_code' => 200,
            'message' => 'Berhasil Login',
            'data' => [
                'user' => Auth::user(),
                'token' => $token,
                'expires_in' => auth('api')->factory()->getTTL() * 60,
            ]
        ]);
    }

    public function getUser()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'http_code' => 404,
                    'errors' => 'Pengguna Tidak Ditemukan!'
                ], 404);
            }
            return response()->json([
                'http_code' => 200,
                'message' => 'Berhasil Menemukan Pengguna!',
                'data' => $user
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'http_code' => 500,
                'errors' => 'Failed to fetch user profile'
            ], 500);
        }
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $e) {
            return response()->json([
                'http_code' => 500,
                'errors' => 'Failed to logout, please try again'
            ], 500);
        }

        return response()->json([
            'http_code' => 200,
            'message' => 'Successfully logged out'
        ]);
    }
}
