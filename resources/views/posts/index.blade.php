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
                                           class="{{ $post->trashed() ? "text-muted" : ''}}">
                                            {{ $post->title }}
                                        </a>
                                        @if($post->trashed())
                                    </del>
                                @endif
                            </h3>

                            @updated(['date' => $post->created_at, 'name' => $post->user->name, 'userId' => $post->user->id])
                            @endupdated

                            @tags(['tags'=> $post->tags]) @endtags

                            <p>{{ trans_choice('messages.comments', $post->comments_count) }}</p>

                            <div class="d-flex align-items-center ">
                                @can('update', $post)
                                    <div class="d-inline-block mr-1 ">
                                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                           class="btn btn-outline-primary btn-block">{{ __('Edit') }}</a>
                                    </div>
                                @endcan
                                @if (! $post->trashed())
                                    @can('delete', $post)
                                        <div class="d-inline-block ml-1">
                                            <form method="POST"
                                                  action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="{{ __('Delete') }}"
                                                       class="btn btn-outline-danger btn-block"/>
                                            </form>
                                        </div>
                                    @endcan
                                @endif
                            </div>
                            <hr class="dashed border-primary border-bottom-0">
                        </div>
                    @empty
                        <h6 class="font-weight-bolder">{{ __("No blog posts yet!") }}</h6>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-4">
            @include('posts._activity')
        </div>
    </div>
@endsection
