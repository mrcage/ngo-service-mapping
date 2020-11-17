@extends('layouts.login')

@section('title', 'Login')

@section('content')
    <form action="{{ route('login') }}" method="POST" class="form-signin text-center">
        @csrf
        <x-bi-door-open class="display-4 mb-4"/>
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        @if (session('status'))
            <x-alert type="success" :message="session('status')"/>
        @endif
        @error('email') <x-alert type="danger" :message="$message"/> @enderror
        @error('password') <x-alert type="danger" :message="$message"/> @enderror
        <label for="inputEmail" class="sr-only">E-mail address</label>
        <input
            type="email"
            name="email"
            id="inputEmail"
            class="form-control"
            placeholder="E-mail address"
            required
            autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input
            type="password"
            name="password"
            id="inputPassword"
            class="form-control"
            placeholder="Password"
            required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" name="remember" value="1"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-2">
            <small><a href="{{ route('password.email') }}">Forgot your password?</a></small>
        </p>
        <p class="mt-5 mb-3 text-muted">
            <a href="{{ route('home') }}">Back to overview</a> |
            <a href="{{ route('register') }}">Register</a>
        </p>
    </form>
@endsection
