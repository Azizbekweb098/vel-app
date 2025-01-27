<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::with(['profile', 'posts'])->findOrFail($id);

        return response()->json([
            'user' => $user
        ]);
    }
}
