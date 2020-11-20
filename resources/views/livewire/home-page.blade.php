<div>
    <h2>Overview</h2>
    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif
    <p>Please choose one of the following areas:</p>
    <p>
        <a href="{{ route('organizations.index') }}" class="btn btn-outline-primary btn-block">List of organizations</a>
    </p>
    <p>
        <a href="{{ route('types.index') }}" class="btn btn-outline-primary btn-block">List of organization types</a>
    </p>
    <p>
        <a href="{{ route('sectors.index') }}" class="btn btn-outline-primary btn-block">List of sectors</a>
    </p>
    <p>
        <a href="{{ route('export') }}" class="btn btn-outline-primary btn-block">Export data</a>
    </p>
</div>
