<style>
    body {
        font-family: Arial, "Helvetica Neue", sans-serif;
    }
</style>

<p>Hi {{ $comment->commentable->user->name }}</p>
<p>
    Someone has commented to your blog post
    <a href="{{ route('posts.show', ['post' => $comment->commentable->id]) }}">
        {{ $comment->commentable->title }}
    </a>
</p>

<hr>

<p>
    <img src="{{ $message->embed($comment->user->image->url()) }}"> <br>
    <a href="{{ route('users.show', ['user' => $comment->user->id]) }}">
        {{ $comment->user->name }}
    </a> said:
</p>

<p>
    "{{ $comment->content }}"
</p>
