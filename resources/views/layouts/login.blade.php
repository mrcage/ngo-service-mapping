<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>@yield('title') | {{ config('app.name') }}</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="d-flex h-100 align-items-center py-5 bg-light">
        @yield('content')
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
