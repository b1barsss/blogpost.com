@extends("layout")

@section("content")
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    @if ($post->image)
                        <div style="background-image: url('{{ $post->image->url() }}'); min-height: 500px; color: white;
                        text-align: center;
                        background-attachment: scroll; background-repeat: no-repeat;  background-size: cover;">
                             <h1 style="padding-top: 100px; text-shadow: 1px 2px #000;">
                    @else
                        <h1>
                    @endif

                        {{ $post->title }}
                        @badge(['type' => null , 'show' => now()->diffInMinutes($post->created_at) < 10])
                            Brand new Post!
                        @endbadge

                    @if ($post->image)
                            </h1>
                        </div>
                    @else
                        </h1>
                    @endif

                    <p> {{ $post->content }}</p>
                        @updated(['date' => $post->created_at, 'name' => $post->user->name, 'userId' => $post->user->id])
                        @endupdated
                        @updated(['date' => $post->updated_at])
                            Updated
                        @endupdated
                    <p>Currently read by {{ $counter }} people.</p>

                    @tags(['tags'=> $post->tags]) @endtags

                    <h4 class="font-weight-bolder">Comments</h4>

                    @commentForm(['route' => route('posts.comments.store', ['post' => $post->id])])
                    @endcommentForm

                    @commentList(['comments' => $post->comments])
                    @endcommentList
                </div>
            </div>
        </div>
        <div class="col-4">
            @include('posts._activity')
        </div>
@endsection


{{--            (added {{ $comment   ->created_at->diffForHumans() }})--}}

{{--    <div class="mt-3">Added {{ $post->created_at->diffForHumans() }}</div>--}}

{{--    <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit</a>--}}


{{--    {{ (new \Carbon\Carbon())->diffInMinutes($post->created_at) }}--}}

{{--If object was created 0-5 min ago, then we see New string on the page!--}}
