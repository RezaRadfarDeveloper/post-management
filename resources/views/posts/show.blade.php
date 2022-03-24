{{$post->title}}
{{$post->content}}

@if(session('status'))
    <div>{{session('status')}}</div>
@endif
