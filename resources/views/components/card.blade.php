<div class="card" style="width: 100%;">
    <div class="card-body">
        <h5 class="card-title text-dark font-weight-bolder">{{ __((string)$title) }}</h5>
        <h6 class="card-subtitle mb-2 text-muted font-italic">
            {{ __((string)$subtitle) }}
        </h6>
    </div>
    <ul class="list-group list-group-flush">
        @if (is_a($items, \Illuminate\Support\Collection::class))
            @foreach ($items as $item)
                <li class="list-group-item">
                    {{ $item }}
                </li>
            @endforeach
        @else
            {{ $items }}
        @endif
    </ul>
</div>
