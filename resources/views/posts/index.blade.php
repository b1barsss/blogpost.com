@extends("layout")

@section("content")
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">


            @forelse ($posts as $post)

                <div class="container">
                    <p>
                        <h3>
                        @if($post->trashed())
                            <del>
                        @endif
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="{{ $post->trashed()? "text-muted" : ''}}">
                                {{ $post->title }}
                            </a>
                        @if($post->trashed())
                             </del>
                        @endif
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
                                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                       class="btn btn-outline-primary btn-block" >Edit</a>
                                </div>
                            @endcan

                            @if (! $post->trashed())
                                @can('delete', $post)
                                    <div class="d-inline-block ml-1">
                                        <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete" class="btn btn-outline-danger btn-block"/>
                                        </form>
                                    </div>
                                @endcan
                            @endif

                                @if ($post->trashed())
                                    @can('restore', $post)
                                        <div class="d-inline-block ml-1">
                                            <form method="POST" action="{{ route('posts.restore', ['post' => $post->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="submit" value="Restore" class="btn btn-outline-success btn-block"/>
                                            </form>
                                        </div>
                                    @endcan
                                @endif
                        </div>
                    </p>
                    <hr class="dashed">
                </div>
            @empty
                <h6 class="font-weight-bolder">No blog posts yet!</h6>
            @endforelse
                </div>
            </div>
        </div>
        <div class="col-4">

            <div class="container">

                <div class="row">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title text-dark font-weight-bolder">Most Commented</h5>
                            <h6 class="card-subtitle mb-2 text-muted font-italic">
                                What people are currently talking about
                            </h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostCommented as $post)
                                <li class="list-group-item">
                                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                        {{ $post->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title text-dark font-weight-bolder">Most Active</h5>
                            <h6 class="card-subtitle mb-2 text-muted font-italic">
                                People with most posts written
                            </h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostActive as $user)
                                <li class="list-group-item">
                                    {{ $user->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title text-dark font-weight-bolder">Most Active Last Month</h5>
                            <h6 class="card-subtitle mb-2 text-muted font-italic">
                                People with most posts written last month
                            </h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostActiveLastMonth as $user)
                                <li class="list-group-item">
                                    {{ $user->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
