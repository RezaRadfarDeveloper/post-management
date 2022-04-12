<p class="text-muted">
    {{empty(trim($slot)) ? 'Added ': $slot}} {{$date->diffForHumans()}} by
    @if(isset($name))
    {{$name}}
        @endif
</p>
