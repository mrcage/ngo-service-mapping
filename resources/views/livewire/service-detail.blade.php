<div>
    <h2>{{ $service->name }} <small class="text-muted">Service</small></h2>

    <p>
        @isset($service->sector)
            <x-bi-pie-chart/>
            <a href="{{ route('sectors.show', $service->sector) }}">{{ $service->sector->name }}</a>
            <br>
        @endif
        <x-bi-diagram-2 title="Organization"/>
        <a href="{{ route('organizations.show', $service->organization) }}">{{ $service->organization->name }}</a>
        <br>
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

    {{-- <p>
        @can('update', $service)
            <a href="{{ $editUrl }}">Edit</a> |
        @endcan
        @can('delete', $service)
            <a href="{{ $deleteUrl }}">Delete</a> |
        @endcan
    </p> --}}
</div>
