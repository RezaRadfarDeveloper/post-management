<div class="card" style="width: 100%;">
    <div class="card-body pt-2"></div>
    <h5 class="card-title m-auto pb-3">{{$title}}</h5>
    <ul class="list-group list-group-flush">
        @if(is_a($items, 'Illuminate\Support\Collection'))
        @foreach($items as $item)
            <li class="list-group-item">
                {{$item}}
            </li>
        @endforeach
        @else
        {{$items}}
        @endif
    </ul>
</div>
