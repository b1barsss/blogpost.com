@extends('layout')

@section('content')
    <form method="post" action=" {{ route("posts.store") }} " enctype="multipart/form-data">
        @csrf

        @include('posts._form')

        <button type="submit" class="btn btn-primary btn-block">{{ __('Create!') }}</button>
    </form>
@endsection
