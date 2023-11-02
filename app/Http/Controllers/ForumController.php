<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Post;

class ForumController extends Controller
{
    public function list(Request $request) : View
    {
        $user = $request->user();
        $page = $request->get('page');
        if (!$page) {
            $page = 0;
        }

        $count = Post::count() / 5;
        $posts = Post::orderBy('created_at', 'desc')->offset($page * 5)->limit(5)->get();

        return view('forum.list', ['page'=>$page, 'posts'=>$posts, 'count'=>$count, 'user'=>$user]);
    }
}
