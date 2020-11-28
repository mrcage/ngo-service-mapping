<div>
    <h2>{{ $location->name }} <small class="text-muted">Location</small></h2>

    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif

    <p class="d-sm-flex justify-content-between">
        @if(isset($location->latitude) && isset($location->longitude))
            <span title="Coordinates">
                <x-bi-map/>
                <a href="{{ route('locations.map', ['coordinates' => $location->coordinates]) }}">
                    {{ $location->coordinates }}
                </a>
            </span>
        @endif
        <span class="d-block d-sm-inline" title="Last updated: {{ $location->updated_at->toUserTimezone() }}">
            <x-bi-clock/> {{ $location->updated_at->diffForHumans() }}
        </span>
    </p>

    @isset($location->description)
        @markdown($location->description)
    @endif

    <p>
        @can('update', $location)
            <a href="{{ route('locations.edit', $location) }}">Edit</a> |
        @endcan
        @can('delete', $location)
            <a href="{{ route('locations.delete', $location) }}">Delete</a>
        @endcan
    </p>

    <hr>
    <div class="d-sm-flex justify-content-between align-items-center">
        <h3>Services</h3>
        @can('create', App\Model\Service::class)
            <a href="{{ route('locations.services.create', $location) }}">Register service</a>
        @endcan
    </div>
    @if($location->services->isNotEmpty())
        @foreach($location->services->sortBy('name') as $service)
            <h5>{{ $service->name }}</h5>
            <p>
                @isset($service->sector)
                    <x-bi-pie-chart title="Sector"/>
                    <a href="{{ route('sectors.show', $service->sector) }}">{{ $service->sector->name }}</a>
                    <br>
                @endif
                <x-bi-diagram-2 title="Organization"/>
                <a href="{{ route('organizations.show', $service->organization) }}">{{ $service->organization->name }}</a>
                <small class="ml-2">
                    <x-bi-tag/>
                    <a href="{{ route('types.show', $service->organization->type) }}">{{ $service->organization->type->name }}</a>
                </small>
                <br>
                @if($service->targetGroups()->exists())
                    <x-bi-people title="Target groups"/>
                    @foreach($service->targetGroups()->orderBy('name')->get() as $targetGroup)
                        <a href="{{ route('target-groups.show', $targetGroup) }}">{{ $targetGroup->name }}</a>@unless($loop->last),@endunless
                    @endforeach
                    <br>
                @endif
            </p>
            @isset($service->description)
                @markdown($service->description)
            @endif
            <p>
                @can('update', $service)
                    <a href="{{ route('locations.services.edit', [$location, $service]) }}">Edit</a>
                @endcan
                @can('delete', $service)
                    | <a href="{{ route('locations.services.delete', [$location, $service]) }}">Delete</a>
                @endcan
            </p>
            <hr>
        @endforeach

        <h3>Coverage</h3>
        @php
            $tabs = [
                'sectors' => [
                    'label' => 'Sectors',
                    'icon' => 'bi-pie-chart'
                ],
                'organizations' => [
                    'label' => 'Organizations',
                    'icon' => 'bi-diagram-2'
                ],
                'targetGroups' => [
                    'label' => 'Target Groups',
                    'icon' => 'bi-people'
                ],
            ];
        @endphp
        <ul class="nav nav-tabs">
            @foreach($tabs as $key => $val)
                <li class="nav-item">
                    <a
                        class="nav-link @if($tab == $key) active @endif"
                        href="#"
                        wire:click.prevent="$set('tab', '{{ $key }}')">
                        <x-dynamic-component component="{{ $val['icon'] }}"/>
                        <span class="d-none d-sm-inline">{{ $val['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
        <div wire:loading class="w-100 my-4">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <div wire:loading.remove>
            @if($tab == 'sectors')
                <div class="list-group list-group-flush mb-3">
                    @foreach($location->sectors()->orderBy('name')->get() as $sector)
                        <a href="{{ route('sectors.show', $sector) }}" class="list-group-item list-group-item-action">
                            {{ $sector->name }}
                        </a>
                    @endforeach
                </div>
            @endif
            @if($tab == 'organizations')
                <div class="list-group list-group-flush mb-3">
                    @foreach($location->organizations()->orderBy('name')->get() as $organization)
                        <a href="{{ route('organizations.show', $organization) }}" class="list-group-item list-group-item-action">
                            {{ $organization->name }}
                        </a>
                    @endforeach
                </div>
            @endif
            @if($tab == 'targetGroups')
                <div class="list-group list-group-flush mb-3">
                    @foreach($location->targetGroups()->sortBy('name') as $targetGroup)
                        <a href="{{ route('target-groups.show', $targetGroup) }}" class="list-group-item list-group-item-action">
                            {{ $targetGroup->name }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    @else
        <p><em>No services registered.</em></p>
    @endisset

    <p>
        <a href="{{ route('locations.index') }}">Return to list of locations</a>
    </p>
</div>
