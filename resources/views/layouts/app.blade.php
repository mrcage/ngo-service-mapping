<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>@isset($title){{ $title }} | @endisset{{ config('app.name') }}</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @livewireStyles
        @stack('styles')
    </head>
    <body class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <x-bi-signpost-split class="h3 p-0 m-0"/>
                    <span class="d-none d-sm-inline">{{ config('app.name') }}</span>
                </a>
                <span class="navbar-text">
                    @auth
                        <a href="{{ route('user-profile-information') }}">{{ Auth::user()->name }}</a> |
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}">Login</a>
                        @if(config('auth.allow_user_registrtion'))
                            | <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endguest
                </span>
            </div>
        </nav>
        <main role="main">
            <div class="container my-3">
                @yield('content')
            </div>
        </main>
        <script src="{{ asset('js/app.js') }}" defer></script>
        @livewireScripts
        @stack('scripts')
    </body>
</html>
