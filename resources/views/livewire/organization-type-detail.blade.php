<div>
    <h2>{{ $type->name }} <small class="text-muted">Organization Type</small></h2>
    @if($type->organizations->isNotEmpty())
        <p>There are {{ $type->organizations->count() }} organizations of this type registered.</p>
        <div class="list-group mb-3">
            @foreach ($type->organizations->sortBy('name') as $organization)
                <a href="{{  route('organizations.show', $organization) }}" class="list-group-item list-group-item-action">
                    {{ $organization->name }}
                </a>
            @endforeach
        </div>
    @else
        <x-alert type="info" message="No organizations assigned."/>
    @endif
    <p>
        <a href="{{ route('types.index') }}">Return to list of organization types</a>
    </p>
</div>
