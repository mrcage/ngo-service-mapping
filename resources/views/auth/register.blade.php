@extends('layouts.login')

@section('title', 'Register')

@section('content')
    <form action="{{ route('register') }}" method="POST" class="form-signin text-center">
        @csrf
        <x-bi-pen class="display-4 mb-4"/>
        <h1 class="h3 mb-3 font-weight-normal">Register new account</h1>
        <div class="form-group text-left">
            <label for="inputName">Name</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                id="inputName"
                class="form-control @error('name') is-invalid @enderror"
                required
                autofocus>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-group text-left">
            <label for="inputEmail">E-mail address</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                id="inputEmail"
                class="form-control @error('email') is-invalid @enderror"
                required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-group text-left">
            <label for="inputPassword">Password</label>
            <input
                type="password"
                name="password"
                id="inputPassword"
                class="form-control @error('password') is-invalid @enderror"
                required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-group text-left">
            <label for="inputPasswordConfirmation">Confirm password</label>
            <input
                type="password"
                name="password_confirmation"
                id="inputPasswordConfirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                required>
            @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        <p class="mt-5 mb-3 text-muted">
            <a href="{{ route('home') }}">Back to overview</a> |
            <a href="{{ route('login') }}">Login</a>
        </p>
    </form>
@endsection
