@extends('layouts.app')
@section('title', 'Index page')

@section('content')
    @if(session('status'))
        <div>{{session('status')}}</div>
    @endif
    @foreach($posts as $key=>$post)
@include('posts.partials.post')
    @endforeach
@endsection
