<div>
    <h2>{{ $sector->name }}</h2>
    @if($sector->organizations->isNotEmpty())
        <p>There are {{ $sector->organizations->count() }} organizations registered in this sector.</p>
        <div class="list-group">
            @foreach ($sector->organizations->sortBy('name') as $organization)
                <a href="{{  route('organizations.show', $organization) }}" class="list-group-item list-group-item-action">
                    {{ $organization->name }}
                </a>
            @endforeach
        </div>
    @else
        <x-alert type="info" message="No organizations assigned."/>
    @endif
</div>