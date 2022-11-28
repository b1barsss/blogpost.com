<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css">
    <title>Blogpost.com</title>
</head>
<body>
{{--<ul>--}}
{{--    <li><a href="{{ route('home') }}">Home</a></li>--}}
{{--    <li><a href="{{ route('contact') }}">Contact</a></li>--}}
{{--    <li><a href="{{ route('posts.index') }}">Blog Posts</a></li>--}}
{{--    <li><a href="{{ route('posts.create') }}">Add Blog Post</a></li>--}}
{{--</ul>--}}

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h4 class="my-0 mr-md-auto font-weight-normal">MeRcuRy6699 Blog</h4>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="{{ route('home') }}">Home</a>
        <a class="p-2 text-dark" href="{{ route('contact') }}">Contact</a>
        <a class="p-2 text-dark" href="{{ route('posts.index') }}">Blog Posts</a>
        <a class="p-2 text-dark" href="{{ route('posts.create') }}">Add Blog Post</a>
    </nav>
</div>

@if(session()->has("status"))
    <p style="color: green">
        {{ session()->get("status") }}
    </p>
@endif
@yield("content")

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
