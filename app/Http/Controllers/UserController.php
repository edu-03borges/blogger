<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{
    public function index() {

        $users = User::All();

        return view('profile.dashboard_user', ['users' => $users]);
    }

    public function admin($id) {

        $user = User::findOrFail($id);

        $user->access_level = 'admin';
        
        $user->save();

        return redirect('/dashboard_users')->with('Msg', 'Msg. User Alterado!');
    }

    public function author($id) {

        $user = User::findOrFail($id);

        $user->access_level = 'author';
        
        $user->save();

        return redirect('/dashboard_users')->with('Msg', 'Msg. User Alterado!');
    }

    public function delete($id) {

        $user = User::findOrFail($id);
        
        $posts = Post::where([
            ['user_id', '=', $user->id]
        ])->with('user')->get();
        
        foreach($posts as $post) {
            $post->comments()->delete();
        }
        
        $user->posts()->delete();
        
        $user->delete();

        return redirect('/dashboard_users')->with('Msg', 'Msg. User Deletado!');
    }
}
