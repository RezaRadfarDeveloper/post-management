@extends('layouts.app')

@section('title', 'Edit page')

@section('content')
    <form method="POST" action="{{route('posts.update',['post'=>$post->id])}}">
        @csrf
        @method('PUT')
        @include('posts.partials.form')
        <div><button type="submit" value="Edit">Edit</button></div>
    </form>
@endsection
