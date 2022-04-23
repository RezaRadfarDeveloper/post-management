<p class="text-muted">
    {{empty(trim($slot)) ? 'Added ': $slot}} {{$date->diffForHumans()}} by
    @if(isset($name))
        @if(isset($userId))
            <a href="{{route('users.show', ['user' => $userId ])}}">{{$name}}</a>
        @else
            {{$name}}
        @endif
    @endif
</p>
