<div>
    @auth
    <form method="post" action="{{ route('posts.comments.store', ['post' => $post->id]) }}">
        @csrf

        <div class="form-group">
            <textarea name="content" class="form-control mb-3" placeholder="Comment..."></textarea>
            <button type="submit" class="btn btn-primary btn-block mt-3">Add comment</button>
        </div>
    </form>
    @errors @enderrors

    @else
        <a href="{{ route('login') }}">Sign in</a> to comment blog posts!
    @endauth
    <hr class="dashed border-primary border-bottom-0">
</div>
