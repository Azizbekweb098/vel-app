<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register;
use App\Jobs\MailCodeJobs;
use App\Jobs\MailJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class RegisterController extends Controller
{
 public function register(Register $request)
 {
    $codetak = rand(100000, 999999);

    Cache::put($codetak, $request->only('name', 'email', 'password'), now()->addMinutes(5));

    MailJobs::dispatch($codetak, $request->email);

    return response()->json(['message' => 'Email ga code yuborildi']);
 }
 public function verify(Request $request)
 {
    $request->validate([
        'code' => ['required', 'integer:6']
    ]);

    $userData = Cache::pull($request->code);

    if(!$userData)
    {
        return response()->json(['message' => 'Code xato yoki eskirgan']);
    }
    $user = User::create([
        'name' => $userData['name'],
        'email' => $userData['email'],
        'password' => Hash::make($userData['password']),
    ]);

    return response()->json(['message' => 'siz royhatdan otdingiz']);
 }
}
