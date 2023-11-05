<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * Comment related to this notification.
     */
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    /**
     * User related to this notification.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
