<div>
    <h2>{{ $organization->name }}</h2>
    <div>
        @if (session()->has('message'))
            <x-alert type="success" :message="session('message')"/>
        @endif
    </div>
    @isset($organization->email)
        <p>
            <x-bi-envelope-fill/>
            <a href="mailto:{{ $organization->email }}">{{ $organization->email }}</a>
        </p>
    @endisset
    @isset($organization->description)
        @markdown($organization->description)
    @else
        <p>
            <em>No description has been provided.</em>
        </p>
    @endif
    <p>
        @can('update', $organization)
            <a href="{{ route('organizations.edit', $organization) }}">Edit</a> |
        @endcan
        @can('delete', $organization)
            <a href="{{ route('organizations.delete', $organization) }}">Delete</a> |
        @endcan
        <a href="{{ route('organizations.index') }}">Return to list</a>
    </p>
</div>
