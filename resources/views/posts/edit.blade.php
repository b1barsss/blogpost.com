@extends('layout')

@section('content')
    <form method="post" action=" {{ route("posts.update", ['post' => $post->id]) }} ">
        @csrf
        @method('PATCH')

        @include('posts._form')

        <button type="submit" class="btn btn-primary btn-block  ">Update!</button>
    </form>
@endsection
