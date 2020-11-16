@extends('layouts.login')

@section('title', 'Request new password')

@section('content')
    <form action="{{ route('password.email') }}" method="POST" class="form-signin text-center">
        @csrf
        <x-bi-lock class="display-4 mb-4"/>
        <h1 class="h3 mb-3 font-weight-normal">Request new password</h1>
        @if (session('status'))
            <x-alert type="success" :message="session('status')"/>
        @else
            <div class="form-group text-left">
                <label for="inputEmail">Your e-mail address</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    id="inputEmail"
                    class="form-control @error('email') is-invalid @enderror"
                    required
                    autofocus
                    aria-describedby="emailHelp">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <small id="emailHelp" class="form-text text-muted">
                    Password recovery instructions will be sent to your registered e-mail address.
                </small>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Send request</button>
        @endif
        <p class="mt-5 mb-3 text-muted">
            <a href="{{ route('login') }}">Back to login</a>
        </p>
    </form>
@endsection
