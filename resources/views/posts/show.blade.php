@extends("layout")

@section("content")

    <h1>{{ $post->title }}</h1>
    <p> {{ $post->content }}</p>
    <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit</a>


{{--    {{ (new \Carbon\Carbon())->diffInMinutes($post->created_at) }}--}}

{{--If object was created 0-5 min ago, then we see New string on the page!--}}
    <div class="mt-3">Added {{ $post->created_at->diffForHumans() }}</div>

    <div class="mt-3">
        @if((new \Carbon\Carbon())->diffInMinutes($post->created_at) < 5)
            <strong>New!</strong>
        @endif
    </div>
@endsection
