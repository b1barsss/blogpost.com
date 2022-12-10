@extends('layout')


@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <img src="{{ $user->image ? $user->image->url() : '' }}"
                         class="img-thumbnail avatar" alt="No photo">
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-4">{{ $user->name }}</h3>

                    @commentForm(['route' => route('users.comments.store', ['user' => $user->id])])
                    @endcommentForm

                    @commentList(['comments' => $user->commentsOn])
                    @endcommentList

                </div>
            </div>
        </div>
    </div>

@endsection
