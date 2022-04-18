@if($errors->any())
    <div class="my-2">
            @foreach($errors->all() as $error)
                <div class="alert-danger alert" role="alert">{{$error}}</div>
            @endforeach
    </div>
@endif
