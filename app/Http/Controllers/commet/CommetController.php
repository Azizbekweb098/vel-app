<?php

namespace App\Http\Controllers\commet;

use App\Http\Controllers\Controller;
use App\Models\CommitLike;
use Illuminate\Http\Request;

class CommetController extends Controller
{
    public function store(Request $request)
    {
        CommitLike::create([
            'like' => $request->like,
            'commets' => $request->commets,
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
        ]);
        return response()->json(['yaratildi']);
    }
}
