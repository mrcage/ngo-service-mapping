@extends('layouts.login')

@section('title', 'Verify e-mail address')

@section('content')
    <form action="{{ route('verification.send') }}" method="POST" class="form-signin text-center">
        @csrf
        <x-bi-lock class="display-4 mb-4"/>
        <h1 class="h3 mb-3 font-weight-normal">Verify e-mail address</h1>
        @if (session('status'))
            @php
                $status = session('status') == 'verification-link-sent' ? 'The verification link has been sent.' : session('status');
            @endphp
            <x-alert type="success" :message="$status"/>
        @else
            <x-alert type="info" message="Please click the e-mail verification link that was sent to your e-mail address."/>
        @endif
        <button class="btn btn-lg btn-primary btn-block" type="submit">Send e-mail again</button>
        <p class="mt-5 mb-3 text-muted">
            <a href="{{ url()->previous() }}">Back to previous page</a>
        </p>
    </form>
@endsection
