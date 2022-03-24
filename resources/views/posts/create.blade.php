@extends('layouts.app')

@section('title', 'Create page')

@section('content')
    <form method="POST" action="{{route('posts.store')}}">
        @csrf
        @include('posts.partials.form')
        <div><button type="submit" value="Create">Create</button></div>
    </form>
@endsection
