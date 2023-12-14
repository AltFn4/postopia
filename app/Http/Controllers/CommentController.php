<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Comment;
use App\Events\CommentAdded;
use App\Models\Post;

class CommentController extends Controller
{
    /**
     * Creates a comment on the post.
     */
    public function create(Request $request)
    {
        $request->validate([
            'post_id' => 'required|numeric',
            'content' => 'required',
        ]);

        $post_id = $request->post_id;
        $user_id = $request->user()->id;
        $content = $request->content;

        if (Post::find($post_id) == NULL) {
            return response()->json('Illegal post id.', 400);
        }

        $comment = new Comment;
        $comment->content = $content;
        $comment->post_id = $post_id;
        $comment->user_id = $user_id;
        $comment->save();

        event(new CommentAdded($comment));
        return view('post.partials.comment', ['comment' => $comment]);
        
    }
}
