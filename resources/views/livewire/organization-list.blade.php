<div>
    <div class="d-sm-flex justify-content-between align-items-center">
        <h2>Organizations</h2>
        @can('create', App\Model\Organization::class)
            <a href="{{ route('organizations.create') }}">Register organization</a>
        @else
            <a href="{{ route('organizations.requestCreateLink') }}">Request to register organization</a>
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
    @if(filled($search) && $organizations->isNotEmpty())
        <p wire:loading.remove>
            <em>Listing {{ $organizations->total() }} organizations matching '{{ trim($search) }}':</em>
        </p>
    @endif
    @if($organizations->isNotEmpty())
        <div class="list-group mb-3">
            @foreach ($organizations as $organization)
                <a href="{{  route('organizations.show', $organization) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    {{ $organization->name }}
                    <small class="d-none d-sm-inline text-right">
                        {{ $organization->type->name }}
                    </small>
                </a>
            @endforeach
        </div>
        {{ $organizations->links() }}
        @if(blank($search))
            <p>
                <small>There are {{ $organizations->total() }} organizations registered.</small>
            </p>
        @endif
    @else
        <x-alert type="info" message="No organizations found."/>
    @endif
</div>
