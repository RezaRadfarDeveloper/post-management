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
            <div class="container">
                <div class="row">
{{--                    <div class="card" style="width: 100%;">--}}
{{--                        <ul class="list-group list-group-flush">--}}
{{--                            @foreach($mostCommented as $post)--}}
{{--                                <li class="list-group-item">--}}
{{--                                    <a href="{{route('posts.show',['post' => $post->id])}}">--}}
{{--                                        {{$post->title}}--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                    <x-card>
                        @slot('title', 'Most Popular')
                            @slot('items')
                            <ul class="list-group list-group-flush">
                                @foreach($mostCommented as $post)
                                    <li class="list-group-item">
                                        <a href="{{route('posts.show',['post' => $post->id])}}">
                                            {{$post->title}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            @endslot
                        </x-card>
                    </div>
                    <div class="row mt-4">
                        <x-card>
                            @slot('title', 'Most Active')
                            @slot('items' , $mostActive)
                        </x-card>
                    </div>
                    <div class="row mt-4">
                        <x-card>
                            @slot('title', 'Most Active monthly')
                            @slot('items', $mostActiveLastMonth)
                        </x-card>
                    </div>
                </div>
            </div>
    @endsection
