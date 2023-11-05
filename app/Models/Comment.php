<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Post related to this comment.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * User who created this comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Notification related to this comment.
     */
    public function notification()
    {
        return $this->hasOne(Notification::class);
    }
}
