@extends('layouts.app')

@section('title', 'Edit page')

@section('content')
    <form method="POST" action="{{route('posts.update',['post'=>$post->id])}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('posts.partials.form')
        <div><button type="submit" value="Edit" class="btn btn-primary w-100">Edit</button></div>
    </form>
@endsection
