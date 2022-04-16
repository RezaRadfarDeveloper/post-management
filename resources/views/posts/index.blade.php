@extends('layouts.app')
@section('title', 'Index page')

@section('content')
    <div class="row mt-4">
        <div class="col-8">
    @foreach($posts as $key=>$post)
@include('posts.partials.post')
    @endforeach
        </div>
        <div class="col-4">
            @include('posts.partials._activity')
        </div>
    </div>
    @endsection
