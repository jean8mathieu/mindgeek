<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MindGeek - @yield('title')</title>
    <link rel="stylesheet" href="{{ mix("/css/app.css") }}">
    <script src="/js/jquery.min.js"></script>
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.4.2/css/all.css"
          integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <meta content="{{ route("home") }}" name="website">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="MindGeek Software Development Assessment!">
    <meta name="author" content="Jean-Mathieu Emond">

</head>
<body>
<nav class="navbar navbar-light bg-dark text-white">
    <div class="container">
        <a class="navbar-brand text-white"
           href="{{ route("home") }}">MindGeek</a>
    </div>
</nav>

@yield('content')

<footer class="footer bg-dark text-white pt-3 pb-2">
    <div class="container">
        <p class="text-center">Copyright © JMDev - {{ date("Y") }}</p>
    </div>
</footer>
<script src="{{ mix("/js/app.js") }}"></script>
@yield('scripts')
</body>
</html>
