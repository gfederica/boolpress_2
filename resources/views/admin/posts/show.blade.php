@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{$post->title}}</h2>
        <small>{{$post->slug}}</small>
        <div class="categories">
            @if ($post->category)
                <a class="btn btn-info">{{$post->category->name}}</a>
            @else 
                <span>Nessuna categoria</span>
            @endif
        </div>
        <div class="tags">
            @if ($post->tags)
                @foreach ($post->tags as $tag)
                     <a class="btn btn-info">{{$tag->name}}</a>
                @endforeach
            @else 
                <span>Nessun tag associato</span>
            @endif
        </div>
        <div class="img">
            @if ($post->cover)
                <img src="{{asset('storage/'.$post->cover)}}" alt="{{$post->slug}}">
            @else
                <img src="{{asset('images/placeholder.png')}}" alt="{{$post->slug}}">
            @endif
            
        </div>
        <p>{{$post->body}}</p>
        <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Torna ai post</a>
    </div>


@endsection