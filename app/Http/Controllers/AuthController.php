<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return response()->json(['message' => 'Пользователь успешно зарегистрирован'], 201);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Неверные данные для входа'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Вы вышли из системы']);
    }
}