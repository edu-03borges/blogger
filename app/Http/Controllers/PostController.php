<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class PostController extends Controller
{
    public function index() {

        $posts = Post::where([
            ['status', '=', 'published']
        ])->with('user')->get();

        $comments = Comment::All();

        return view('posts.news_home', ['posts' => $posts, 'comments' => $comments]);
    }

    public function create() {
        return view('posts.create_post');
    }

    public function publish($id) {

        $post = Post::findOrFail($id);

        $post->status = 'published';

        $post->save();

        return redirect('/my_posts')->with('msg', 'Msg. Post publicado');
    }

    public function draft($id) {

        $post = Post::findOrFail($id);

        $post->status = 'draft';

        $post->save();

        return redirect('/my_posts')->with('msg', 'Msg. Post Arquivado');
    }

    public function store(Request $request) {

        $post = new Post;

        $post->title = $request->title;
        $post->description = $request->description;
        
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            
            $requestImage = $request->image;

            $extension = $requestImage->extension(); 

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now') . '.' . $extension);

            $request->image->move(public_path('img/posts'), $imageName);

            $post->image = $imageName;
        }

        $user = auth()->user();
        $post->user_id = $user->id;

        $post->save();

        return redirect('/')->with('Msg', 'Msg. Post Arquivado como Rascunho!');
    }

    public function getInfo($id) {
        $post = Post::findOrFail($id);

        return view('posts.edit_new', ['post' => $post]);
    }

    public function update(Request $request, $id) {

        $post = Post::findOrFail($id);

        $post->title = $request->title;
        $post->description = $request->description;
        
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            
            $requestImage = $request->image;

            $extension = $requestImage->extension(); 

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now') . '.' . $extension);

            $request->image->move(public_path('img/posts'), $imageName);

            $post->image = $imageName;
        }

        $user = auth()->user();
        $post->user_id = $user->id;

        $post->save();

        return redirect('/my_posts')->with('Msg', 'Msg. Post Alterado!');
    }

    public function delete($id) {

        $post = Post::findOrFail($id);
        
        $post->comments()->delete();
        
        $post->delete();

        return redirect('/my_posts')->with('Msg', 'Msg. Post Deletado!');
    }

    public function show() {

        $user = auth()->user();

        if($user->access_level == 'admin') {
            $posts = Post::with('user')->get();
        } else {
            $posts = Post::where([
                ['user_id', '=', $user->id]
            ])->get();
        }

        $comments = Comment::with('post')->get();

        return view('posts.my_posts', ['posts' => $posts, 'comments' => $comments]);
    }
}
