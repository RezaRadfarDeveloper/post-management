<div class="my-2">
@auth
    <form method="POST" action="{{route('posts.comments.store', ['post'=> $post->id])}}">
        @csrf
        <div class="form-group">
            <textarea class="form-control" id="content" name="content" cols="30" rows="4"></textarea>
        </div>
        <div><button type="submit" value="Create" class="btn btn-primary w-100">Add a comment</button></div>
    </form>
@else
    <a href="{{route('login')}}">Sign in</a> To add comments.
@endauth
<x-errors></x-errors>
</div>
<hr>
