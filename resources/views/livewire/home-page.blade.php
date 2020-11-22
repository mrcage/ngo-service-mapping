<div>
    <h2>Overview</h2>

    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif

    <livewire:verify-email-notification/>

    <p>Please choose one of the following areas:</p>
    <p>
        <a href="{{ route('organizations.index') }}" class="btn btn-outline-primary btn-block">List of organizations</a>
    </p>
    <p>
        <a href="{{ route('locations.index') }}" class="btn btn-outline-primary btn-block">List of locations</a>
    </p>
    <p>
        <a href="{{ route('types.index') }}" class="btn btn-outline-primary btn-block">List of organization types</a>
    </p>
    <p>
        <a href="{{ route('sectors.index') }}" class="btn btn-outline-primary btn-block">List of sectors</a>
    </p>
    @can('viewAny', App\Model\User::class)
    <p>
        <a href="{{ route('users.index') }}" class="btn btn-outline-primary btn-block">Manage users</a>
    </p>
    @endcan
    <p>
        <a href="{{ route('export') }}" class="btn btn-outline-primary btn-block">Export data</a>
    </p>
</div>
