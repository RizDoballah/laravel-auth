@extends('layouts.app')
@section('content')
  <div class="btn-group ml-3 mb-3">
    <a class="btn btn-primary" href="{{route('adminposts.create')}}">Crea un nuovo post</a>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>User Name</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
        <tr>
          <td>{{$post->id}}</td>
          <td>{{$post->title}}</td>
          <td>{{$post->user->name}}</td>
          <td>{{$post->created_at}}</td>
          <td>{{$post->updated_at}}</td>
          <td><a class="btn btn-primary" href="{{route('adminposts.show', $post->slug)}}">View</a></td>
          <td><a class="btn btn-primary" href="{{route('adminposts.edit', $post->slug)}}">Edit</a> </td>
          <td>
            <form class="" action="{{route('adminposts.destroy',$post)}}" method="post">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" class="" type="submit">Delete</button>
            </form>
          </td>
        </tr>

      @endforeach
    </tbody>
  </table>

@endsection
