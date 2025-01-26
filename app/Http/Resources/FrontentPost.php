<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FrontentPost extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->name, // user bilan bog'liq name qiymati
            'name' => $this->name,
            'content' => $this->content,
            'image' => $this->image,
           'like' => $this->commitLikes()->liked()->count(),
           'comment' => Commet::collection($this->commitLikes),
        ];
    }
    
}
