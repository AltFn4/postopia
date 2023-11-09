<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Post;
use App\Models\Image;
use Storage;

class PostController extends Controller
{
    public function index(Request $request) : View
    {
        $user = $request->user();
        $page = $request->get('page');
        if (!$page) {
            $page = 0;
        }

        $count = Post::count() / 5;
        $posts = Post::orderBy('created_at', 'desc')->offset($page * 5)->limit(5)->get();

        return view('post.index', ['page'=>$page, 'posts'=>$posts, 'count'=>$count, 'user'=>$user]);
    }

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
            'files.*' => 'mimes:png,jpg,jpeg',
        ]);

        $id = $request->user()->id;
        $title = $request->title;
        $content = $request->content;
        
        $post = new Post;
        $post->title = $title;
        $post->content = $content;
        $post->user_id = $id;
        $post->save();

        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach ($files as $key => $file) {
                $path = Storage::disk('public')->putFile('images', $file);
                $name = str_replace('images/', '', $path);

                $image = new Image;
                $image->name = $name;
                $image->post_id = $post->id;
                $image->save();
            }
        }

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
