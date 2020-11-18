<div>
    <h2>{{ $organization->name }}</h2>
    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif
    @isset($organization->email)
        <p>
            <x-bi-envelope-fill/>
            <a href="mailto:{{ $organization->email }}">{{ $organization->email }}</a>
        </p>
    @endisset
    @isset($organization->website)
        <p>
            <x-bi-globe/>
            <a href="{{ $organization->website }}" target="_blank">{{ $organization->website }}</a>
        </p>
    @endisset
    @if($organization->sectors->isNotEmpty())
        <p><strong>Sectors:</strong> {{ $organization->sectors->sortBy('name')->map(fn ($s) => $s->name)->implode(', ') }}</p>
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
        @elseif(isset($organization->email))
            <a href="{{ route('organizations.requestEditLink', $organization) }}">Request change</a> |
        @endcan
        @can('delete', $organization)
            <a href="{{ route('organizations.delete', $organization) }}">Delete</a> |
        @endcan
        <a href="{{ route('organizations.index') }}">Return to list</a>
    </p>
</div>
