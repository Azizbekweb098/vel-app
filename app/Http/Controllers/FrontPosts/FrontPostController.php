<?php

namespace App\Http\Controllers\FrontPosts;

use App\Http\Controllers\Controller;
use App\Http\Resources\FrontentPost;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontPostController extends Controller
{
    public function index()
    {
        $post = Post::all();

        return response()->json(FrontentPost::collection($post));
    }
}
