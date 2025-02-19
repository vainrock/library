<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Librarian;
use JWTAuth;

class LibrarianAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Здесь можно использовать отдельный guard
        if (!$token = auth('librarian')->attempt($credentials)) {
            return response()->json(['error' => 'Неверные данные для входа'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        auth('librarian')->logout();
        return response()->json(['message' => 'Вы вышли из системы']);
    }
}