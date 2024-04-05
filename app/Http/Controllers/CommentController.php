<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $id) {

        $post = Post::findOrFail($id);

        $comment = new Comment;

        $user = auth()->user();

        $comment->name = $user->name;
        $comment->post_id = $post->id;
        $comment->description = $request->description;

        $comment->save();

        return redirect('/')->with('msg', 'Post Alterado!');
    }
}
