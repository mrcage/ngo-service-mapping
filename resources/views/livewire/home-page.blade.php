<div>
    <h2>Overview</h2>
    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif
    <p>Please choose one of the following modules:</p>
    <p>
        <a href="{{ route('organizations.index') }}" class="btn btn-outline-primary btn-block">List of organizations</a>
    </p>
</div>
