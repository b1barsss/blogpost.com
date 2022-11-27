@extends("layout")

@section("content")

    <h1>{{ $post->title }}</h1>
    <p> {{ $post->content }}</p>
    <i>
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit</a>
    </i>
{{--    <p>Added {{ $post->created_at->diffForHumans() }}</p>--}}

{{--    {{ (new \Carbon\Carbon())->diffInMinutes($post->created_at) }}--}}

{{--If object was created 0-5 min ago, then we see New string on the page!--}}

    <p>
        @if((new \Carbon\Carbon())->diffInMinutes($post->created_at) < 5)
            <strong>New!</strong>
        @endif
    </p>
@endsection
