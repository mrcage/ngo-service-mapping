<div>
    <h2>{{ $location->name }} <small class="text-muted">Location</small></h2>

    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif

    <p class="d-sm-flex justify-content-between">
        @if(isset($location->latitude) && isset($location->longitude))
            <span title="Coordinates">
                <x-bi-geo-alt/>
                <a href="http://www.google.com/maps/place/{{ $location->latitude }},{{ $location->longitude }}" target="_blank">
                    {{ $location->latitude }}, {{ $location->longitude }}
                </a>
            </span>
        @endif
        <span class="d-block d-sm-inline" title="Last updated: {{ $location->updated_at->toUserTimezone() }}">
            <x-bi-clock/> {{ $location->updated_at->diffForHumans() }}
        </span>
    </p>

    @isset($location->description)
        @markdown($location->description)
    @else
        <p>
            <em>No description has been provided.</em>
        </p>
    @endif

    @if($location->services->isNotEmpty())
        <h3>Services</h3>
        @foreach($location->services->sortBy('name') as $service)
            <h5>{{ $service->name }}</h5>
            <p><x-bi-diagram-2/> <a href="{{ route('organizations.show', $service->organization) }}">{{ $service->organization->name }}</a></p>
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
        <h3>Organizations</h3>
        <ul>
            @foreach($location->organizations()->orderBy('name')->get() as $organization)
                <li>
                    <a href="{{ route('organizations.show', $organization) }}">{{ $organization->name }}</a>
                </li>
            @endforeach
        </ul>
    @endisset

    <p>
        {{-- TODO --}}
        <a href="{{ route('locations.index') }}">Return to list of locations</a>
    </p>
</div>
