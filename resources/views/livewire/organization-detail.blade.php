<div>
    <h2>{{ $organization->name }} <small class="text-muted">Organization</small></h2>

    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif

    <p>
        <x-bi-tag-fill/>
        <a href="{{ route('types.show', $organization->type) }}">{{ $organization->type->name }}</a>
    </p>

    @isset($organization->description)
        @markdown($organization->description)
    @else
        <p>
            <em>No description has been provided.</em>
        </p>
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

    @if($organization->services->isNotEmpty())
        <h3>Services</h3>
        @foreach($organization->services->sortBy('name') as $service)
            <h5>{{ $service->name }}</h5>
            <p><x-bi-geo-alt/> <a href="{{ route('locations.show', $service->location) }}">{{ $service->location->name }}</a></p>
            @if($service->targetGroups->isNotEmpty())
                <p><x-bi-people/>
                    @foreach($service->targetGroups as $targetGroup)
                        <a href="{{ route('target-groups.show', $targetGroup) }}">{{ $targetGroup->name }}</a>@unless($loop->last),@endunless
                    @endforeach
                </p>
            @endif
            @isset($service->description)
                @markdown($service->description)
            @endif
        @endforeach
        <h3>Locations</h3>
        <ul>
            @foreach($organization->locations()->get()->sortBy('name') as $location)
                <li>
                    <a href="{{ route('locations.show', $location) }}">{{ $location->name }}</a>
                </li>
            @endforeach
        </ul>
    @endisset

    @if($organization->sectors->isNotEmpty())
        <h3>Sectors</h3>
        <ul>
            @foreach($organization->sectors->sortBy('name') as $sector)
                <li>
                    <a href="{{ route('sectors.show', $sector) }}">{{ $sector->name }}</a>
                </li>
            @endforeach
        </ul>
    @endisset

    <p>
        @can('update', $organization)
            <a href="{{ route('organizations.edit', $organization) }}">Edit</a> |
        @elseif(isset($organization->email))
            <a href="{{ route('organizations.requestEditLink', $organization) }}">Request change</a> |
        @endcan
        @can('delete', $organization)
            <a href="{{ route('organizations.delete', $organization) }}">Delete</a> |
        @endcan
        <a href="{{ route('organizations.index') }}">Return to list of organizations</a>
    </p>
</div>
