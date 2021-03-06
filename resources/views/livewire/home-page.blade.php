<div>
    <h2>Overview</h2>

    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif

    <livewire:verify-email-notification/>

    <p>Please choose one of the following areas:</p>
    <p>
        <a href="{{ route('organizations.index') }}" class="btn btn-outline-primary btn-block"><x-bi-diagram-2/> List of organizations</a>
    </p>
    <p>
        <a href="{{ route('locations.index') }}" class="btn btn-outline-primary btn-block"><x-bi-geo-alt/> List of locations</a>
    </p>
    <p>
        <a href="{{ route('locations.map') }}" class="btn btn-outline-primary btn-block"><x-bi-map/> Map of locations</a>
    </p>
    <p>
        <a href="{{ route('types.index') }}" class="btn btn-outline-primary btn-block"><x-bi-tag/> List of organization types</a>
    </p>
    <p>
        <a href="{{ route('sectors.index') }}" class="btn btn-outline-primary btn-block"><x-bi-pie-chart/> List of sectors</a>
    </p>
    <p>
        <a href="{{ route('target-groups.index') }}" class="btn btn-outline-primary btn-block"><x-bi-people/> List of target groups</a>
    </p>
    @can('viewAny', App\Model\User::class)
    <p>
        <a href="{{ route('users.index') }}" class="btn btn-outline-primary btn-block"><x-bi-person-badge/> User management</a>
    </p>
    @endcan
    <p>
        <a href="{{ route('export') }}" class="btn btn-outline-primary btn-block"><x-bi-download/> Data export</a>
    </p>
</div>
