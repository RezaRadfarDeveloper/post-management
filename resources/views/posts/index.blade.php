@extends('layouts.app')
@section('title', 'Index page')

@section('content')
    <div class="row">
        <div class="col-8">
    @foreach($posts as $key=>$post)
@include('posts.partials.post')
    @endforeach
        </div>
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    @foreach($mostCommented as $post)
                    <li class="list-group-item">
                        <a href="{{route('posts.show',['post' => $post->id])}}">
                        {{$post->title}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
