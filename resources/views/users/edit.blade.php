@extends('layouts.app')

@section('content')
    <form action="{{route('users.update', ['user' => $user->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <div class="row">
        <div class="col-4">
            <img src="{{$user->image->url()}}" class="img-thumbnail avatar" alt="">
            <div class="card mt-4">
                <div class="card-body">
                    <h6>Upload Different Image</h6>
                    <input type="file" name="avatar" class="form-control-file">
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="form-group">
                <label for="">Name:</label>
                <input type="text" name="name" value="" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit"  value="Save changes" class="btn btn-primary">
            </div>
        </div>
    </div>
    </form>
    <x-errors></x-errors>

@endsection
