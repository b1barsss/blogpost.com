@extends("layout")

@section("content")
@forelse ($posts as $post)
    <div class="container">
        <p>
            <h3>
                <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
            </h3>

            <p class="text-muted" >
                Added {{ $post->created_at->diffForHumans() }}
                by {{ $post->user->name }}
            </p>
            @if($post->comments_count)
                <p>{{ $post->comments_count }} comments</p>
            @else
                <p><span class="">No comments yet!</span></p>
            @endif

            <div class="d-flex align-items-center ">
                @can('update', $post)
                    <div class="d-inline-block mr-1 ">
                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary btn-block" >Edit</a>
                    </div>
                @endcan
                @can('delete', $post)
                    <div class="d-inline-block ml-1">
                        <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger btn-block"/>
                        </form>
                    </div>
                @endcan
            </div>
        </p>
    </div>
@empty
    <h6 class="font-weight-bolder">No blog posts yet!</h6>
@endforelse
@endsection
