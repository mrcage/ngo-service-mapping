<div>
    <h2>Organizations</h2>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <p><a href="{{ route('organizations.create') }}">Register organization</a></p>
    <p>Filter: <input wire:model.debounce.500ms="search" type="search"/></p>
    @if(filled($search))
        <p><em>Listing {{ $organizations->count() }} organizations matching '{{ trim($search) }}':</em></p>
    @endif
    @if($organizations->isNotEmpty())
        <ul>
            @foreach ($organizations as $organization)
                <li>
                    <a href="{{  route('organizations.show', $organization) }}">{{ $organization->name }}</a>
                </li>
            @endforeach
        </ul>
        @if(blank($search))
            <p><small>There are {{ $organizations->count() }} organizations registered.</small></p>
        @endif
    @else
        <p>No organizations found.</p>
    @endif
</div>
