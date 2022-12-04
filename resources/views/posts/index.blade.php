@extends("layout")

@section("content")
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    @forelse ($posts as $post)
                        <div class="container">
                            <h3>
                                @if($post->trashed())
                                    <del>
                                        @endif
                                        <a href="{{ route('posts.show', ['post' => $post->id]) }}"
                                           class="{{ $post->trashed()? "text-muted" : ''}}">
                                            {{ $post->title }}
                                        </a>
                                        @if($post->trashed())
                                    </del>
                                @endif
                            </h3>

                            @updated(['date' => $post->created_at, 'name' => $post->user->name])
                            @endupdated

                            @if($post->comments_count)
                                <p>{{ $post->comments_count }} comments</p>
                            @else
                                <p><span class="">No comments yet!</span></p>
                            @endif

                            <div class="d-flex align-items-center ">
                                @can('update', $post)
                                    <div class="d-inline-block mr-1 ">
                                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                           class="btn btn-outline-primary btn-block">Edit</a>
                                    </div>
                                @endcan
                                @if (! $post->trashed())
                                    @can('delete', $post)
                                        <div class="d-inline-block ml-1">
                                            <form method="POST"
                                                  action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete"
                                                       class="btn btn-outline-danger btn-block"/>
                                            </form>
                                        </div>
                                    @endcan
                                @endif
                                @if ($post->trashed())
                                    @can('restore', $post)
                                        <div class="d-inline-block ml-1">
                                            <form method="POST"
                                                  action="{{ route('posts.restore', ['post' => $post->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="submit" value="Restore"
                                                       class="btn btn-outline-success btn-block"/>
                                            </form>
                                        </div>
                                    @endcan
                                @endif
                            </div>
                            <hr class="dashed border-primary border-bottom-0">
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
                    @card(['title' => 'Most Commented'])
                        @slot('subtitle')
                            What people are currently talking about
                        @endslot
                        @slot('items')
                            @foreach ($mostCommented as $post)
                                <li class="list-group-item">
                                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                        {{ $post->title }}
                                    </a>
                                    @if ((auth()->user()->is_admin) ?? false)
                                        <div class="text-muted font-italic" style="display: block;">
                                            {{ $post->comments_count }} comments
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        @endslot
                    @endcard

                </div>
                <div class="row mt-3">
                    @card(['title' => 'Most Active'])
                        @slot('subtitle')
                            People with most posts written
                        @endslot
                        @slot('items', collect($mostActive)->pluck('name'))
                    @endcard
                </div>
                <div class="row mt-3">
                    @card(['title' => 'Most Active Last Month'])
                        @slot('subtitle')
                            People with most posts written last month
                        @endslot
                        @slot('items', collect($mostActiveLastMonth)->pluck('name'))
                    @endcard
                </div>
            </div>
        </div>
    </div>
@endsection
