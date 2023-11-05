<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * Post related to this image.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
