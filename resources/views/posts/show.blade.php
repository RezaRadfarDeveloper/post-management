@extends('layouts.app')
@section('title', $post->title)

@section('content')
    <div class="row mt-4">
        <div class="col-8">
            @if($post->image)
            <div style="background-image: url('{{$post->image->url()}}'); min-height: 400px; margin-bottom: 20px;text-align: center;color: white;background-attachment: fixed">
                <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">
            @else
                <h1>
            @endif
                {{$post->title}}
                <p>Added {{$post->created_at->diffForHumans()}}</p>
            @if(!$post->image)
                </h1>
            @else
                </h1>
            </div>
            @endif
            <p>{{$post->content}}</p>
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
