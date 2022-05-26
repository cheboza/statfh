<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
    <title>@yield('title-page')</title>
</head>
<body>
    <div class="title">
        <h1>@yield('title')</h1>
    </div>
    @yield('content')
</body>
</html>