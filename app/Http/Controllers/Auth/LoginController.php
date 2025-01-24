<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
    
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['xat' => 'Xatolik']);
        }
    
        $user = Auth::user();
        
        // Token yaratish
        $token = $user->createToken('Vel Token')->plainTextToken;
    
        return response()->json([
            'message' => 'Siz Dasturga kirdizgiz',
            'token' => $token,
        ]);
    }
    
}
