@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <form class="" action="{{route('adminposts.update', $post)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="title">Title</label>
          <input class="form-control" type="text" name="title" value="{{$post->title}}{{old('title')}}">
        </div>
        <div class="form-group">
          <label for="body">Body</label>
          <textarea class="form-control" name="body" rows="8" cols="80">{{$post->body}}{{old('body')}}</textarea>
        </div>
        <div class="form-group">
          <label for="tags">Tags</label>
          @foreach ($tags as $tag)
            <div class="">
              <span>{{$tag->name}}</span>
              <input type="checkbox" name="tags[]" value="{{$tag->id}}" {{($post->tags->contains($tag->id)) ? 'checked' : ''}}>
            </div>
          @endforeach
        </div>
        <div class="form-group">
          <label for="published">Pubblicato</label>
          <select name="published">
            <option value="0" {{($post->published == 0) ? 'checked' : ''}}>Non published</option>
            <option value="1" {{($post->published == 1) ? 'checked' : ''}}>Published</option>
          </select>
        </div>
        <div class="form-group">
          @isset($post->image_path)
            <img src="{{asset('storage/' . $post->image_path)}}" alt="">
          @endisset
          <input type="file" name="image_path" accept="image/*">
        </div>
        {{-- <input type="hidden" name="user_id" value="{{Auth::id()}}"> --}}
        <button class="btn btn-success" type="submit" name="button">Salva</button>
      </form>
    </div>
  </div>

@endsection
