<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Post;
use DB;


class ForumController extends Controller
{
    public function list(Request $request) : View
    {
        $page = $request->get('page');
        if (!$page) {
            $page = 0;
        }

        $count = Post::count() / 5;
        $posts = DB::table('posts')->offset($page * 5)->limit(5)->get();

        return view('forum.list', ['page'=>$page, 'posts'=>$posts, 'count'=>$count]);
    }
}
