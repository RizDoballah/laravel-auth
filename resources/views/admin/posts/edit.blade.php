@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <form class="" action="{{route('adminposts.update', $post)}}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="title">Title</label>
          <input class="form-control" type="text" name="title" value="{{$post->title}}">
        </div>
        <div class="form-group">
          <label for="body">Body</label>
          <textarea class="form-control" name="body" rows="8" cols="80">{{$post->body}}</textarea>
        </div>
        {{-- <input type="hidden" name="user_id" value="{{Auth::id()}}"> --}}
        <button class="btn btn-success" type="submit" name="button">Salva</button>
      </form>
    </div>
  </div>

@endsection
