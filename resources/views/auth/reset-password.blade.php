@extends('layouts.login')

@section('title', 'Reset password')

@section('content')
    <form action="{{ route('password.update') }}" method="POST" class="form-signin text-center">
        @csrf
        <x-bi-lock class="display-4 mb-4"/>
        <h1 class="h3 mb-3 font-weight-normal">Reset password</h1>
        @if (session('status'))
            <x-alert type="success" :message="session('status')"/>
        @else
            <input type="hidden" name="token" value="{{ request()->route('token') }}"/>
            <div class="form-group text-left">
                <label for="inputEmail">E-mail address</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    id="inputEmail"
                    class="form-control @error('email') is-invalid @enderror"
                    required
                    autofocus>
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
            <button class="btn btn-lg btn-primary btn-block" type="submit">Update password</button>
        @endif
    </form>
@endsection
