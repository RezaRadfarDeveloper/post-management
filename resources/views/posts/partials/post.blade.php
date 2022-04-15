<h3>
    @if($post->trashed())
        <del>
    @endif
    <a href="{{route('posts.show',['post' =>$post->id])}}" class="{{$post->trashed()? 'text-muted': ''}}">{{$post->title}}
    </a>
    @if($post->trashed())
        </del>
    @endif
</h3>
<x-updated :name="$post->user->name" :date="$post->created_at">
</x-updated>
<x-tags :tags="$post->tags"></x-tags>
@if($post->comments_count)
<p>{{$post->comments_count}}</p>
@else
    <p>No comment yet!!</p>
@endif
<div class="mb-3">
    @auth
    @can('update', $post)
    <a href="{{route('posts.edit',['post' =>$post->id])}}" class="btn btn-primary">Edit</a>
    @endcan
    @endauth
    @auth
        @if(!$post->trashed())
            @can('delete', $post)
                <form class="d-inline" action="{{route('posts.destroy',['post' =>$post->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete!" class="btn btn-primary">
                </form>
            @endcan
        @endif
    @endauth
</div>

