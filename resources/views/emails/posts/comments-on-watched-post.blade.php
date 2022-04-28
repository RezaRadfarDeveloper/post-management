<div>
    <h1>Dear {{$user->name}}</h1>
    <p>
        Someone has commented on your post titled as "<a href="{{route('posts.show',['post' => $comment->commentable->id])}}">"
            {{$comment->commentable->title}}
        </a>
    </p>

    <p>{{$comment->content}}</p>

</div>
