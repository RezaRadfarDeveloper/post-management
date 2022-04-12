@extends('layouts.app')
@section('title', $post->title)

@section('content')
    <h3>{{$post->title}}</h3>
    <p>{{$post->content}}</p>
    <p>Added {{$post->created_at->diffForHumans()}}</p>

       <x-badge type="success" :show="now()->diffInMinutes($post->created_at) < 300" />

    @if(!$post->comments)
        No comment yet!
    @else
        @foreach($post->comments as $comment)
            <p>{{$comment->content}}</p>
            <x-updated :date="$comment->created_at"></x-updated>
        @endforeach
    @endif
@endsection
