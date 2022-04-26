<div>
    <h1>Dear {{$comment->commentable->user->name}}</h1>
    <p>
      Someone has commented on your post titled as "<a href="{{route('posts.show',['post' => $comment->commentable->id])}}">"
            {{$comment->commentable->title}}
        </a>
    </p>
    <p>
        check the user profile here:
        <a href="{{route('users.show', ['user' => $comment->user->id])}}">{{$comment->user->name}}</a>
    </p>
    <p>{{$comment->content}}</p>
</div>
