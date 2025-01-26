<?php

namespace App\Models;

use App\Models\CommitLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'content', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
     public function commitLikes()
     {
        return $this->hasMany(CommitLike::class);
     }
}
