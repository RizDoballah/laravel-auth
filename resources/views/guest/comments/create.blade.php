{{-- @extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <form  action="{{route('comments.store')}}" method="post">
      @csrf
      @method('post')
      <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control" type="text" name="name" value="">
      </div>
      <div class="form-group">
        <label for="name">Email</label>
        <input class="form-control" type="text" name="email" value="">
      </div>
      <div class="form-group">
        <label for="name">Comment</label>
        <textarea class="form-control" name="body" rows="8" cols="80"></textarea>
      </div>
      <input type="hidden" name="post_id" value="@foreach ($comments as $comment)
        {{$comment->post->id}}
      @endforeach">
      <button class="btn btn-success" type="submit" name="button">Save</button>

    </form>

  </div>
</div>

@endsection --}}
