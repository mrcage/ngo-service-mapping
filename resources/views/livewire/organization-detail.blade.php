<div>
    <h2>{{ $organization->name }}</h2>
    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif
    @if($organization->sectors->isNotEmpty())
        <p>
            <strong>Sectors:</strong>
            @foreach($organization->sectors->sortBy('name') as $sector)
                <a href="{{ route('sectors.show', $sector) }}">{{ $sector->name }}</a>@unless($loop->last), @endunless
            @endforeach
        </p>
    @endisset
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
