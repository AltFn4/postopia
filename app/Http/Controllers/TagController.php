<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:20'
        ]);

        if (Tag::where(['name' => $request->name])->count() > 0) {
            return response()->json('Tag exists', 400);
        }

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->colour = fake()->hexColor();
        $tag->save();

        return view('post.partials.tag-button', ['tag' => $tag]);
    }
}
