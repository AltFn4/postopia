<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Post;

class PostController extends Controller
{
    public function show(Request $request)
    {
        $id = $request->id;
        $post = Post::find($id);
        return view('post.show', ['post'=>$post, 'user'=>$request->user()]);
    }

    public function edit(Request $request) : View
    {
        return view('post.edit', ['user'=>$request->user()]);
    }

    public function create(Request $request) : RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $id = $request->user()->id;
        $title = $reqest->title;
        $content = $request->content;
        
        $post = new Post;
        $post->title = $title;
        $post->content = $content;
        $post->user_id = $id;
        $post->save();

        return back()->with('status', 'post-created');
    }

    public function update(Request $request) : RedirectResponse
    {
        $request->validate([
            'id' => 'required',
            'content' => 'required',
        ]);
        $id = $request->id;
        $content = $request->content;
        Post::where('id', $id)->update(['content'=>$content]);
        return back();
    }

    public function destroy(Request $request) : RedirectResponse
    {
        $id = $request->id;
        $success = Post::find($id)->delete();
        return back();
    }
}
