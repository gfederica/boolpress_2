@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{$post->title}}</h2>
        <small>{{$post->slug}}</small>
        <div class="img">
            <img src="{{asset($post->cover)}}" alt="{{$post->slug}}">
        </div>
        <p>{{$post->body}}</p>
        <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Torna ai post</a>
    </div>


@endsection