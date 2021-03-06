<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;


class PostController extends Controller
{
  private $validateRules;

  public function __construct()
  {
    $this->validateRules = [
      'tags.*' => 'exists:tags,id',
      'title'=> 'required|string|max:255',
      'body'=> 'required|string',
      'published'=> 'required|boolean',
      'image_path'=>'nullable|image'
    ];
  }
  //solo admin
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts= Post::where('user_id', Auth::id())->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idUser = Auth::user()->id;
        $request->validate($this->validateRules);

        $data = $request->all();
        $newPost = new Post;

        if(empty($data['image_path'])) {
           $data['image_path'] = null;
       } else {
           $data['image_path'] = Storage::disk('public')->put('images', $data['image_path']);
       }


        $newPost->title = $data['title'];
        $newPost->body = $data['body'];
        $newPost->user_id = $idUser;
        $newPost->slug = Str::finish(Str::slug($newPost->title), rand(1, 1000));
        $newPost->published = $data['published'];
        $newPost->image_path = $data['image_path'];

        $saved = $newPost->save();
        if (!$saved) {
          return redirect()->back();
        }
        $tags= $data['tags'];
        if (!empty($tags)) {
          $newPost->tags()->attach($tags);
        }
        return redirect()->route('adminposts.show', $newPost->slug);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post =Post::where('slug', $slug)->first();

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
      $post = Post::where('slug', $slug)->first();
      $tags = Tag::all();

      $data = [
        'tags' => $tags,
        'post' => $post
      ];

      return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      $idUser = Auth::user()->id;
       if(empty($post)){
           abort(404);
       }

       if($post->user->id != $idUser){
           abort(404);
       }

       $data = $request->all();
       $request->validate($this->validateRules);

       if(!empty($data['image_path'])) {
         $data['image_path'] = Storage::disk('public')->put('images', $data['image_path']);
        }

       $updated = $post->update($data);

       if (!$updated) {
           return redirect()->back()->withinput();
       }

       $tags = $data['tags'];
       if (!empty($tags)) {
         $post->tags()->sync($tags);
       }

       return redirect()->route('adminposts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
      if (empty($post)) {
        abort('404');
      }
      $post->tags()->detach();
      $post->delete();

      return redirect()->route('adminposts.index');
    }
}
