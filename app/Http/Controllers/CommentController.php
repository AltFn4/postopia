<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Comment;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);
        $post_id = $request->id;
        $user_id = $request->user()->id;
        $content = $request->content;

        if ($content !== NULL) {
            $comment = new Comment;
            $comment->content = $content;
            $comment->post_id = $post_id;
            $comment->user_id = $user_id;
            $comment->save();
        }
        
        return back()->withInput();
    }
}
