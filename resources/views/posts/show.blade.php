@extends('layouts.app')
@section('title', $post->title)

@section('content')
    <div class="row mt-4">
        <div class="col-8">
            <h3>{{$post->title}}</h3>
            <p>{{$post->content}}</p>
            <p>Added {{$post->created_at->diffForHumans()}}</p>
            <x-tags :tags="$post->tags"></x-tags>
            visited by {{$counter}} people
            <h4>Comments</h4>
            @include('comments._form')
               <x-badge type="success" :show="now()->diffInMinutes($post->created_at) < 300" />

            @if(!$post->comments)
                No comment yet!
            @else
                @foreach($post->comments as $comment)
                    <p>{{$comment->content}}</p>
                    <x-updated :date="$comment->created_at" :name="$comment->user->name"></x-updated>
                @endforeach
            @endif
        </div>
        <div class="col-4">
            @include('posts.partials._activity')
        </div>
    </div>

@endsection
