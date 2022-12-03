@extends("layout")

@section("content")
    <div class="row">
        <div class="col-8">
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
                                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                       class="btn btn-primary btn-block" >Edit</a>
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
