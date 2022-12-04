@if (!isset($show) || $show)
    <h4>
        <span class="badge badge-{{ $type ?? 'success'}}">
            {{ $slot }}
        </span>
    </h4>
@endif

