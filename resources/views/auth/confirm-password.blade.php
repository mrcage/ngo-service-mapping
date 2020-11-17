@extends('layouts.login')

@section('title', 'Confirm password')

@section('content')
    <form action="{{ route('password.confirm') }}" method="POST" class="form-signin text-center">
        @csrf
        <x-bi-door-closed class="display-4 mb-4"/>
        <h1 class="h3 mb-3 font-weight-normal">Please confirm your password</h1>
        @if (session('status'))
            <x-alert type="success" :message="session('status')"/>
        @endif
        @error('password') <x-alert type="danger" :message="$message"/> @enderror
        <input
            type="password"
            name="password"
            id="inputPassword"
            class="form-control"
            placeholder="Password"
            required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Verify</button>
        <p class="mt-5 mb-3 text-muted">
            <a href="{{ url()->previous() }}">Cancel</a>
        </p>
    </form>
@endsection
