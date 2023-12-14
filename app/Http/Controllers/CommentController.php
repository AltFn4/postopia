<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Comment;
use App\Events\CommentAdded;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'post_id' => 'required',
            'content' => 'required',
        ]);
        $post_id = $request->post_id;
        $user_id = $request->user()->id;
        $content = $request->content;

         $comment = new Comment;
        $comment->content = $content;
        $comment->post_id = $post_id;
        $comment->user_id = $user_id;
        $comment->save();

        event(new CommentAdded($comment));
        return view('post.partials.comment', ['comment' => $comment]);
        
    }
}
