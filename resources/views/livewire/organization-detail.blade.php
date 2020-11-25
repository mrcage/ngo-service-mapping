<div>
    <h2>
        {{ $organization->name }}
        @isset($organization->abbreviation)({{ $organization->abbreviation }})@endisset
        <small class="text-muted">Organization</small>
    </h2>

    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif

    <p class="d-sm-flex justify-content-between">
        <span title="Organization type">
            <x-bi-tag-fill/>
            <a href="{{ route('types.show', $organization->type) }}">{{ $organization->type->name }}</a>
        </span>
        <span class="d-block d-sm-inline" title="Last updated: {{ $organization->updated_at->toUserTimezone() }}">
            <x-bi-clock/> {{ $organization->updated_at->diffForHumans() }}
        </span>
    </p>

    @isset($organization->description)
        @markdown($organization->description)
    @else
        <p>
            <em>No description has been provided.</em>
        </p>
    @endif

    <p>
        @isset($organization->email)
            <x-bi-envelope-fill/>
            <a href="mailto:{{ $organization->email }}">{{ $organization->email }}</a>
            <br>
        @endisset
        @isset($organization->phone)
            <x-bi-telephone/>
            <a href="{{ telUrl($organization->phone) }}">{{ $organization->phone }}</a>
            <br>
        @endisset
        @isset($organization->website)
            <x-bi-globe/>
            <a href="{{ $organization->website }}" target="_blank">{{ $organization->website }}</a>
            <br>
        @endisset
        @isset($organization->facebook)
            <x-bi-globe title="Facebook"/>
            <a href="{{ $organization->facebook }}" target="_blank">{{ $organization->facebook }}</a>
            <br>
        @endisset
        @isset($organization->instagram)
            <x-bi-globe title="Instagram"/>
            <a href="{{ $organization->instagram }}" target="_blank">{{ $organization->instagram }}</a>
            <br>
        @endisset
        @isset($organization->twitter)
            <x-bi-globe title="Twitter"/>
            <a href="{{ $organization->twitter }}" target="_blank">{{ $organization->twitter }}</a>
            <br>
        @endisset
        @isset($organization->youtube)
            <x-bi-globe title="YouTube"/>
            <a href="{{ $organization->youtube }}" target="_blank">{{ $organization->youtube }}</a>
            <br>
        @endisset
        @isset($organization->linkedin)
            <x-bi-globe title="LinkedIn"/>
            <a href="{{ $organization->linkedin }}" target="_blank">{{ $organization->linkedin }}</a>
            <br>
        @endisset
    </p>

    <p>
        @can('update', $organization)
            <a href="{{ route('organizations.edit', $organization) }}">Edit</a>
        @elseif(isset($organization->email))
            <a href="{{ route('organizations.requestEditLink', $organization) }}">Request change</a>
        @endcan
        @can('delete', $organization)
            | <a href="{{ route('organizations.delete', $organization) }}">Delete</a>
        @endcan
    </p>

    <hr>
    <div class="d-sm-flex justify-content-between align-items-center">
        <h3>Services</h3>
        @can('create', App\Model\Service::class)
            <a href="{{ route('organizations.services.create', $organization) }}">Register service</a>
        @endcan
    </div>
    @if($organization->services->isNotEmpty())
        @foreach($organization->services->sortBy('name') as $service)
            <h5>{{ $service->name }}</h5>
            <p>
                @isset($service->sector)
                    <x-bi-pie-chart/>
                    <a href="{{ route('sectors.show', $service->sector) }}">{{ $service->sector->name }}</a>
                    <br>
                @endif
                <x-bi-geo-alt/>
                <a href="{{ route('locations.show', $service->location) }}">{{ $service->location->name }}</a>
                <br>
                @if($service->targetGroups()->exists())
                    <x-bi-people/>
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
                    <a href="{{ route('organizations.services.edit', [$organization, $service]) }}">Edit</a>
                @endcan
                @can('delete', $service)
                    | <a href="{{ route('organizations.services.delete', [$organization, $service]) }}">Delete</a>
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
                'locations' => [
                    'label' => 'Locations',
                    'icon' => 'bi-geo-alt'
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
                    @foreach($organization->sectors()->orderBy('name')->get() as $sector)
                        <a href="{{ route('sectors.show', $sector) }}" class="list-group-item list-group-item-action">
                            {{ $sector->name }}
                        </a>
                    @endforeach
                </div>
            @endif
            @if($tab == 'locations')
                <div class="list-group list-group-flush mb-3">
                    @foreach($organization->locations()->orderBy('name')->get() as $location)
                        <a href="{{ route('locations.show', $location) }}" class="list-group-item list-group-item-action">
                            {{ $location->name }}
                        </a>
                    @endforeach
                </div>
            @endif
            @if($tab == 'targetGroups')
                <div class="list-group list-group-flush mb-3">
                    @foreach($organization->targetGroups()->sortBy('name') as $targetGroup)
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
        <a href="{{ route('organizations.index') }}">Return to list of organizations</a>
    </p>
</div>
