@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>{{$post->title}}</h2>
        <span>by: {{$post->user->name}}</span>
        <div class="mt-3">
          {{$post->body}}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 ">
        <h3 class="mt-4">Comments</h3>
        @forelse ($post->comments as $comment)
          <h5 class="mt-4">{{$comment->name}}</h5>
          <small>{{$comment->email}}</small>
          <div class="mt-3">
            {{$comment->body}}
          </div>
        @empty
          <p>No Comments</p>
        @endforelse
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12">
        <h2>Insert a comment</h2>
        <div class="container">
          <form class="" action="{{route('comments.store')}}" method="post">
            @csrf
            @method('post')
            <div class="form-group">
              <label for="title">Name</label>
              <input class="form-control" type="text" name="name">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input class="form-control"  type="text" name="email">
            </div>
            <div class="form-group">
              <label for="body">body</label>
              <textarea class="form-control"  name="body" id="body" cols="30" rows="10"></textarea>
            </div>
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <button class="btn btn-success" type="submit">Save</button>
          </form>
        </div>
      </div>

    </div>

  </div>






@endsection
