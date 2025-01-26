<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitLike extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'like', 'commets'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function scopeLiked($query)
{
    return $query->where('like', 1);
}
}
