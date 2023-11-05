<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * User who created this post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Comments created in this post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Images attached to this post.
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
