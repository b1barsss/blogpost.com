@extends("layout")

@section("content")
@forelse ($posts as $post)
    <div class="container">
        <p>
            <h3>
                <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
            </h3>

            @if($post->comments_count)
                <p>{{ $post->comments_count }} comments</p>
            @else
                <p>No comments yet!</p>
            @endif

            <div class="row">
                <div class="col-md-1">
                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary btn-block" >Edit</a>
                </div>
                <div class="col-md-0">
                    <form method="POST" class="form-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete!" class="btn btn-danger btn-block"/>
                    </form>
                </div>
            </div>
        </p>
    </div>
@empty
    <p>No blog posts yet!</p>
@endforelse
@endsection
