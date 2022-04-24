
@if(!$comments->count())
    No comment yet!
@else
    @foreach($comments as $comment)
    <p>{{$comment->content}}</p>
    <x-updated :date="$comment->created_at" :name="$comment->user->name" :userId="$comment->user->id"></x-updated>
    @endforeach
@endif
