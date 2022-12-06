<p>
    @foreach($tags as $tag)
        <a href="{{ route('posts.tags.index',['tag' => $tag->id]) }}"
           style="font-size:1.0rem;" class="badge badge-success badge-lg">{{ $tag->name }}</a>
    @endforeach
</p>
