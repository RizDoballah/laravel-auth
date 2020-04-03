@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row">
      <div class="col-12">
        <img src="{{asset('storage/' . $post->image_path)}}" alt="">
        <h2>{{$post->title}}</h2>
        <h4>Written by : {{$post->user->name}}</h4>
        <div>
          {{$post->body}}
        </div>
      </div>
    </div>
  </div>

@endsection
