@extends('layouts.app')
@section('content')
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>User Id</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="1"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
        <tr>
          <td>{{$post->id}}</td>
          <td>{{$post->title}}</td>
          <td>{{$post->user_id}}</td>
          <td>{{$post->created_at}}</td>
          <td>{{$post->updated_at}}</td>
          <td><a class="btn btn-info" href="{{route('posts.show', $post)}}">View</a></td>
        </tr>

      @endforeach
    </tbody>
  </table>

@endsection
