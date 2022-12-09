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
                    <h3>{{ $user->name }}</h3>
                </div>
            </div>
        </div>

    </div>

@endsection
