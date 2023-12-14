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
    /**
     * Displays 5 posts in descending order of their id.
     */
    public function index(Request $request) : View
    {
        $request->validate([
            'page' => 'numeric',
        ]);

        $page = $request->get('page');
        if (!$page) {
            $page = 0;
        }

        $count = Post::count() / 5;
        $posts = Post::orderBy('id', 'desc')->offset($page * 5)->limit(5)->get();

        return view('post.index', ['page'=>$page, 'posts'=>$posts, 'count'=>$count]);
    }

    /**
     * Displays the post.
     */
    public function show(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric'
        ]);

        $id = $request->id;
        $post = Post::find($id);

        if ($post !== NULL) {
            return view('post.show', ['post'=>$post]);
        }
        
        return back();
    }

    /**
     * Displays a form for creating a post.
     */
    public function edit(Request $request) : View
    {
        return view('post.edit');
    }

    /**
     * Creates a new post.
     */
    public function create(Request $request) : RedirectResponse
    {
        $request->validate([
            'title' => 'required|max:20',
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

    /**
     * Updates a post.
     */
    public function update(Request $request) : RedirectResponse
    {
        $request->validate([
            'id' => 'required|numeric',
            'content' => 'required',
        ]);

        $user = $request->user();
        $id = $request->id;
        $content = $request->content;
        $post = Post::find($id);

        if ($post !== NULL && ($user->role->canEdit || $user->id == $post->user->id)) {
            $post->update(['content'=>$content]);
        }
        
        return back();
    }

    /**
     * Deletes a post.
     */
    public function destroy(Request $request) : RedirectResponse
    {
        $request->validate([
            'id' => 'required|numeric',
        ]);

        $user = $request->user();
        $id = $request->id;
        $post = Post::find($id);

        if ($post !== NULL && ($user->role->canDelete || $user->id == $post->user->id)) {
            $post->delete();
        }

        return back();
    }
}
