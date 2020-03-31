@extends('layouts.app')
@section('content')

  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>User Id</th>
        <th>Body</th>
        <th>Comments</th>
        <th>Created At</th>
        <th>Updated At</th>
      </tr>
    </thead>
    <tbody>
        <tr>
          <td>{{$post->id}}</td>
          <td>{{$post->title}}</td>
          <td>{{$post->user_id}}</td>
          <td>{{$post->body}}</td>
          <td>{{$post->created_at}}</td>
          <td>{{$post->updated_at}}</td>
        </tr>
    </tbody>
  </table>
  <div class="row">
    <div class="col-12 ml-3">
      <h3>Comments</h3>
      @forelse ($post->comments as $comment)
        <h5>{{$comment->name}}</h5>
        <small>{{$comment->email}}</small>
        <div>
          {{$comment->body}}
        </div>
      @empty
        <p>No Comments</p>
      @endforelse
    </div>
  </div>

    <div class="row mt-4">
      <div class="col-12 ml-3">
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




@endsection
