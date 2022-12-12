<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css">
    <script src="{{ mix('js/app.js') }}"></script>
    <title>blogpost.com</title>
</head>
<body>
{{--<ul>--}}
{{--    <li><a href="{{ route('home') }}">Home</a></li>--}}
{{--    <li><a href="{{ route('contact') }}">Contact</a></li>--}}
{{--    <li><a href="{{ route('posts.index') }}">Blog Posts</a></li>--}}
{{--    <li><a href="{{ route('posts.create') }}">Add Blog Post</a></li>--}}
{{--</ul>--}}
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-bold text-primary">MeRcuRy6699 Blog</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="{{ route('home') }}">{{ __('Home') }}</a>
            <a class="p-2 text-dark" href="{{ route('contact') }}">{{ __('Contact') }}</a>
            <a class="p-2 text-dark" href="{{ route('posts.index') }}">{{ __('Blog Posts') }}</a>
            <a class="p-2 text-dark" href="{{ route('posts.create') }}">{{ __('Add') }}</a>

            @guest
                @if(Route::has('register'))
                    <a class="p-2 text-dark" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
                    <a class="p-2 text-dark" href="{{ route('login') }}">{{ __('Login') }}</a>
            @else
                <a class="p-2 text-dark"
                   href="{{ route('users.show',['user' => Auth::user()->id]) }}">
                    {{ __('Profile') }}
                </a>
                <a class="p-2 text-dark"
                   href="{{ route('users.edit',['user' => Auth::user()->id]) }}">
                    {{ __('Edit Profile') }}
                </a>
                <a class="p-2 text-dark" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }} ({{ Auth::user()->name }})</a>

                <form method="POST" id="logout-form" action="{{ route('logout') }}" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @endguest


        </nav>
    </div>

    <div class="container">
        @if(session()->has('status'))
            <div class="row">
                <h3 class="badge badge-success" style="position: absolute; top: 8.6%; left: 15%;">
                    {{ session()->get('status') }}
                </h3>
            </div>
        @endif

        @yield('content')

    </div>

</body>
</html>
