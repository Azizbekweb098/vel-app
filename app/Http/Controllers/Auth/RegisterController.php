<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\MailCodeJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $verificationCode = rand(100000, 999999);

        Cache::put($verificationCode, $request->only('name', 'email', 'password'), now()->addMinutes(5));

       MailCodeJobs::dispatch($request->email, $verificationCode);

        return response()->json(['message' => 'Tasdiqlash kodi emailga yuborildi.']);
    }

 
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);


        $userData = Cache::pull($request->code);

        if (!$userData) {
            return response()->json(['message' => 'Kod noto‘g‘ri yoki muddati o‘tgan.'], 400);
        }


        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
        ]);

        return response()->json(['message' => 'Hisob muvaffaqiyatli ro\'yxatdan o\'tdi.', 'user' => $user]);
    }
}
