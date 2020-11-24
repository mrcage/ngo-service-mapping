<div>
    <div class="d-sm-flex justify-content-between align-items-center">
        <h2>Locations</h2>
        @can('create', App\Model\Location::class)
            <a href="{{ route('locations.create') }}">Register location</a>
        @endcan
    </div>
    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif
    <div class="input-group mb-3 mt-2">
        <div class="input-group-prepend">
            <span class="input-group-text">Filter</span>
        </div>
        <input
            wire:model.debounce.500ms="search"
            type="search"
            id="search"
            class="form-control"/>
    </div>
    <p wire:loading>Searching...</p>
    @if(filled($search) && $locations->isNotEmpty())
        <p wire:loading.remove>
            <em>Listing {{ $locations->total() }} locations matching '{{ trim($search) }}':</em>
        </p>
    @endif
    @if($locations->isNotEmpty())
        <div class="list-group mb-3">
            @foreach ($locations as $location)
                <a href="{{  route('locations.show', $location) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    {{ $location->name }}
                    <small class="d-none d-sm-inline text-right">
                        {{ $location->services()->count() }} services
                    </small>
                </a>
            @endforeach
        </div>
        {{ $locations->links() }}
        @if(blank($search))
            <p>
                <small>There are {{ $locations->total() }} locations registered.</small>
            </p>
        @endif
    @else
        <x-alert type="info" message="No locations found."/>
    @endif
</div>
