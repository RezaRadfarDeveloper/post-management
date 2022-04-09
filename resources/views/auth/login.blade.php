@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control ">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
        </div>

        <p class="sign-up">Don't have an Account?<a href="{{ route('register') }}"> Sign Up</a></p>
    </form>
    @if($errors->any())
        <div>
            <ul class="list-group">
                @foreach($errors->all() as $error)
                    <li class="list-group-item list-group-item-danger">{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

