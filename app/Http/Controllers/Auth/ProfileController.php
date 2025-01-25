<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show()
    {
        $profile = Auth::user()->profile;
    
        return response()->json($profile);
    }

    public function update(Request $request)
    {
        $profile = Auth::user()->profile;

        if (!$profile) {
            return response()->json(['error' => 'Profil topilmadi'], 404);
        }

        // Faylni tekshirish va yuklash
        if ($request->hasFile('image')) {
            // Faylni saqlash
            $image = $request->file('image');
            $imagePath = $image->store('profiles', 'public'); // 'profiles' - katalog nomi, 'public' - disk
            $profile->image = $imagePath; // Rasmning yo'lini saqlash
        }

        // Yangi bio va linklarni yangilash
        $profile->update($request->only(['bio', 'link']));

        return response()->json($profile);
    }

    public function userupdate(Request $request)
    {
        $user = Auth::user(); 
        $user->name = $request->input('name');
        $user->email = $request->input('email');
    
        
        $user->save(); 
    
        return response()->json(['message' => 'Malumot Ozgartirildi']);
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();
    
        
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['message' => 'Eski parol noto\'g\'ri.'], 400);
        }

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|min:8|confirmed',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => 'Parolni tasdiqlash xatoliklari mavjud.'], 400);
        }
    
    
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        return response()->json(['message' => 'Parol muvaffaqiyatli yangilandi.'], 200);
    
}
}
