<div class="container">
    <div class="row">
        <x-card>
            @slot('title', 'Most Popular')
            @slot('items')
                <ul class="list-group list-group-flush">
                    @foreach($mostCommented as $post)
                        <li class="list-group-item">
                            <a href="{{route('posts.show',['post' => $post->id])}}">
                                {{$post->title}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endslot
        </x-card>
    </div>
    <div class="row mt-4">
        <x-card>
            @slot('title', 'Most Active')
            @slot('items' , collect($mostActive)->pluck('name'))
        </x-card>
    </div>
    <div class="row mt-4">
        <x-card>
            @slot('title', 'Most Active monthly')
            @slot('items', collect($mostActiveLastMonth)->pluck('name'))
        </x-card>
    </div>
</div>
