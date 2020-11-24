<div>
    <h2>{{ $targetGroup->name }} <small class="text-muted">Target Group</small></h2>
    @if($targetGroup->services->isNotEmpty())
        <p>There are {{ $targetGroup->services()->count() }} services covering this target group.</p>
        @php
            $tabs = [
                'services' => [
                    'label' => 'Services',
                    'icon' => 'bi-life-preserver'
                ],
                'organizations' => [
                    'label' => 'Organizations',
                    'icon' => 'bi-diagram-2'
                ],
                'locations' => [
                    'label' => 'Locations',
                    'icon' => 'bi-geo-alt'
                ],
                'sectors' => [
                    'label' => 'Sectors',
                    'icon' => 'bi-pie-chart'
                ],
                'organizationTypes' => [
                    'label' => 'Org. Types',
                    'icon' => 'bi-tag'
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
            @if($tab == 'services')
                <ul class="list-group list-group-flush mb-3">
                    @foreach ($targetGroup->services()->orderBy('name')->get() as $service)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $service->name }}
                            <small class="text-right">
                                <x-bi-diagram-2/>
                                <a href="{{  route('organizations.show', $service->organization) }}">{{ $service->organization->name }}</a>
                                <br>
                                <x-bi-geo-alt/>
                                <a href="{{  route('locations.show', $service->location) }}">{{ $service->location->name }}</a>
                            </small>
                        </li>
                    @endforeach
                </ul>
            @endif
            @if($tab == 'organizations')
                <div class="list-group list-group-flush mb-3">
                    @foreach ($targetGroup->organizations()->sortBy('name') as $organization)
                        <a href="{{ route('organizations.show', $organization) }}" class="list-group-item list-group-item-action  d-flex justify-content-between align-items-center">
                            {{ $organization->name }}
                            <small class="d-none d-sm-inline">{{ $organization->type->name }}</small>
                        </a>
                    @endforeach
                </div>
            @endif
            @if($tab == 'locations')
                <div class="list-group list-group-flush mb-3">
                    @foreach ($targetGroup->locations()->sortBy('name') as $location)
                        <a href="{{ route('locations.show', $location) }}" class="list-group-item list-group-item-action">
                            {{ $location->name }}
                        </a>
                    @endforeach
                </div>
            @endif
            @if($tab == 'sectors')
                <div class="list-group list-group-flush mb-3">
                    @foreach ($targetGroup->sectors()->sortBy('name') as $sector)
                        <a href="{{ route('sectors.show', $sector) }}" class="list-group-item list-group-item-action">
                            {{ $sector->name }}
                        </a>
                    @endforeach
                </div>
            @endif
            @if($tab == 'organizationTypes')
                <div class="list-group list-group-flush mb-3">
                    @foreach ($targetGroup->organizationTypes()->sortBy('name') as $type)
                        <a href="{{ route('types.show', $type) }}" class="list-group-item list-group-item-action">
                            {{ $type->name }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    @else
        <x-alert type="info" message="No services assigned."/>
    @endif
    <p>
        <a href="{{ route('target-groups.index') }}">Return to list of target groups</a>
    </p>
</div>
