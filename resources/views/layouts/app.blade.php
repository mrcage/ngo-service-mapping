<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title }} | {{ config('app.name') }}</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @livewireStyles
    </head>
    <body class="d-flex flex-column h-100">
        <main role="main" class="flex-shrink-0">
            <div class="container my-3">
                {{ $slot }}
            </div>
        </main>
        <footer class="footer mt-auto py-3 bg-light">
            <div class="container text-center">
                @auth
                    Logged in as <strong>{{ Auth::user()->name }}</strong> |
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login') }}">Login</a> |
                    <a href="{{ route('register') }}">Register</a>
                @endguest
            </div>
          </footer>
        <script src="{{ asset('js/app.js') }}" defer></script>
        @livewireScripts
    </body>
</html>
