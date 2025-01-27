<?php

namespace App\Http\Controllers\search;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        if(!$query)
        {
            return response()->json(['error' => 'Topilmadi']);
        }

        $post = Post::where('name' ,'LIKE', "%{$query}%")->orWhere('content', 'LIKE', "%{$query}%")->get();

        $profile = User::where('name' ,'LIKE', "%{$query}%")->with('profile') // profile bilan bog'liq ma'lumotlarni olish
        ->get();

        return response()->json([
            'posts' => $post,
            'profiles' => $profile,
        ]);
    }
}
