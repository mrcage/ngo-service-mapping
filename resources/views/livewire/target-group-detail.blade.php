<div>
    <h2>{{ $targetGroup->name }} <small class="text-muted">Target Group</small></h2>
    @if($targetGroup->services->isNotEmpty())
        <p>There are {{ $targetGroup->services->count() }} services covering this target group.</p>
        <ul class="list-group mb-3">
            @foreach ($targetGroup->services->sortBy('name') as $service)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $service->name }}</span>
                    <small class="text-right">
                        <x-bi-diagram-2/> <a href="{{  route('organizations.show', $service->organization) }}">{{ $service->organization->name }}</a><br>
                        <x-bi-geo-alt/> <a href="{{  route('locations.show', $service->location) }}">{{ $service->location->name }}</a>
                    </small>
                </li>
            @endforeach
        </ul>
    @else
        <x-alert type="info" message="No services assigned."/>
    @endif
    <p>
        <a href="{{ route('target-groups.index') }}">Return to list of target groups</a>
    </p>
</div>
