@extends('layout')
@section("content")
    <h1 class="text-primary">Welcome to Contact!</h1>
    <p>Hello from Contact!</p>
    @can('home.secret')
        <p class="font-weight-bold">
            <a href="{{ route('secret') }}">
                Go to special contact details!
            </a>
        </p>
    @endcan
@endsection
