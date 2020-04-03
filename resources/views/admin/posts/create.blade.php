@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <form class="" action="{{route('adminposts.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
          <label for="title">Title</label>
          <input class="form-control" type="text" name="title" value="">
        </div>
        <div class="form-group">
          <label for="body">Body</label>
          <textarea class="form-control" name="body" rows="8" cols="80"></textarea>
        </div>
        <div class="form-group">
          <label for="tags">Tags</label>
          @foreach ($tags as $tag)
            <div class="">
              <span>{{$tag->name}}</span>
              <input type="checkbox" name="tags[]" value="{{$tag->id}}">
            </div>
          @endforeach
        </div>
        <div class="form-group">
         <label for="published">Pubblicato</label>
         <select name="published">
           <option value="0">Non published</option>
           <option value="1">Published</option>
         </select>
        </div>
        <div class="form-group">
         <input type="file" name="path_image" accept="image/*">
        </div>
        {{-- <input type="hidden" name="user_id" value="{{Auth::id()}}"> --}}
        <button class="btn btn-success" type="submit" name="button">Salva</button>
      </form>
    </div>
  </div>

@endsection
