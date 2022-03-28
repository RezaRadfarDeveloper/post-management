<div style="background-color: #4a5568">{{$key}}.{{$post->title}}</div>
<form action="{{route('posts.destroy',['post' =>$post->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <input type="submit" value="Delete!!">
</form>
