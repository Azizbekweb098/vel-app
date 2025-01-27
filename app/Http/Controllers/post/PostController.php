<?php

namespace App\Http\Controllers\post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\FrontentPost;
use App\Models\Post;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
  public $imageService;

  public function __construct(ImageService $imageService)
  {
    $this->imageService = $imageService;
  }
    public function index()
    {
      return response()->json(FrontentPost::collection(auth()->user()->posts));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $validated = $request->all();
    if($request->hasFile('image')) {
        $validated['image'] = $this->imageService->upload($request->file('image'));
    }
     $post = Auth::user()->posts()->create($validated);

     return response()->json($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reqesutData = Post::find($id);
        if(!$reqesutData)
        {
            return response()->json(['error' => 'Bunday Post Yoq']);
        }
   return response()->json(new FrontentPost($reqesutData));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        $this->authorize('update', $post);
      
        $validated  = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if($request->hasFile('image')) 
        {
            $validated['image'] = $this->imageService->upload($request->file('image'));
        }

        $post->update($validated);

        return response()->json(['message' => 'Post Tahrirlandi', $post]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        $this->authorize('delete', $post);

        $post->delete();
        return response()->json(['message' => 'Post Ochirildi']);
    }
}
