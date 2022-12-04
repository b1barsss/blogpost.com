@extends("layout")

@section("content")
    <h1>
        {{ $post->title }}
        @badge(['type' => null , 'show' => now()->diffInMinutes($post->created_at) < 10])
            Brand new Post!
        @endbadge
    </h1>
    <p> {{ $post->content }}</p>
        @updated(['date' => $post->created_at, 'name' => $post->user->name])
        @endupdated
        @updated(['date' => $post->updated_at])
            Updated
        @endupdated

    <h4 class="font-weight-bolder">Comments</h4>
    @forelse($post->comments as $comment)
        <p>
            {{ $comment->content }}
        </p>
        @updated(['date' => $comment->created_at])
        @endupdated
    @empty
        <p>No Comments yet!</p>
    @endforelse

@endsection


{{--            (added {{ $comment   ->created_at->diffForHumans() }})--}}

{{--    <div class="mt-3">Added {{ $post->created_at->diffForHumans() }}</div>--}}

{{--    <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit</a>--}}


{{--    {{ (new \Carbon\Carbon())->diffInMinutes($post->created_at) }}--}}

{{--If object was created 0-5 min ago, then we see New string on the page!--}}
