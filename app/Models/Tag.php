<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * Posts that belong to this category.
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
