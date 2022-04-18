@extends('layouts.app')

@section('title', 'Create page')

@section('content')
    <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
        @csrf
        @include('posts.partials.form')
        <div><button type="submit" value="Create" class="btn btn-primary w-100">Create</button></div>
    </form>
@endsection
