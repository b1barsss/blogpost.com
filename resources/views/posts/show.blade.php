@extends("layout")

@section("content")

    <h1>{{ $post->title }}</h1>
    <p> {{ $post->content }}</p>

{{--    <p>Added {{ $post->created_at->diffForHumans() }}</p>--}}

{{--    {{ (new \Carbon\Carbon())->diffInMinutes($post->created_at) }}--}}

{{--If object was created 0-5 min ago, then we see New string on the page!--}}

        @if((new \Carbon\Carbon())->diffInMinutes($post->created_at) < 5)
            <strong>New!</strong>
        @endif
@endsection
