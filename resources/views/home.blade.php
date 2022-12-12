@extends('layout')

@section("content")

<h1  class="text-primary">{{ __('Welcome to Laravel!') }}</h1>
{{--<h1  class="text-primary">@lang('messages.welcome')</h1>--}}


{{--<p>Using JSON: {{ __('Welcome to Laravel!') }}</p>--}}

{{--<p>{{ __('messages.example_with_value', ['name' => 'Biba']) }}</p>--}}

{{--<p>{{ trans_choice('messages.plural', 0) }}</p>--}}
{{--<p>{{ trans_choice('messages.plural', 1) }}</p>--}}
{{--<p>{{ trans_choice('messages.plural', 2) }}</p>--}}
{{----}}
{{--<p>Using JSON: {{ __('Hello :name', ['name' => 'Bibarys']) }}</p>--}}


<p>This is the content of the main page!</p>


@endsection
