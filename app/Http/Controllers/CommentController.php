<?php

namespace App\Http\Controllers;
use App\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
  private $validateRules;
  public function __construct()
  {
    $this->validateRules = [
      'name'=>'required|string|max:50',
      'email'=>'required|email',
      'body'=> 'required|string|max:255',
      'post_id'=> 'required|numeric|exists:posts,id'
    ];
  }
  public function create() {

    // $comments = Comment::all();
    //
    // return view('guest/comments/create', compact('comments'));
  }

  public function store(Request $request) {

    $request->validate($this->validateRules);

        $data = $request->all();

        $comment = new Comment;
        $comment->fill($data);
        $saved = $comment->save();

        if(!$saved) {
            return redirect()->back();
        }

        return redirect()->route('posts.show', $comment->post);
  }
}
