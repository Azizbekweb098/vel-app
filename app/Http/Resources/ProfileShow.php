<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileShow extends JsonResource
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
            'name' => $this->user->name,  // Foydalanuvchining ismi
            'bio' => $this->bio,  // Bio (agar bor bo'lsa)
            'profile_picture' => asset('storage/' . $this->image), // Profil rasmi
            'posts' => $this->posts,  // Foydalanuvchining postlari
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
