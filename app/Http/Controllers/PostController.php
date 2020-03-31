<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    //utenti guest e admin
    public function index() {
      $posts = Post::all();
      return view('guest.posts.index', compact('posts'));
    }

    public function show(Post $post) {

      if (empty($post)) {
        abort('404');
      }

      return view('guest.posts.show', compact('post'));
    }
}
