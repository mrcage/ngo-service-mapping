<div>
    <div class="d-sm-flex justify-content-between align-items-center">
        <h2>Organization Types</h2>
        @can('create', App\Model\OrganizationType::class)
            <a href="{{ route('types.manage') }}">Manage organization types</a>
        @endcan
    </div>
    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif
    @if($types->isNotEmpty())
        <div class="list-group my-3">
            @foreach ($types as $type)
                <a href="{{  route('types.show', $type) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>{{ $type->name }}</span>
                    <small>{{ $type->organizations->count() }} organizations</small>
                </a>
            @endforeach
        </div>
        <p><small>There are {{ $types->count() }} types assigned to any organization.</small></p>
    @else
        <x-alert type="info" message="No types registered or assigned to organizations."/>
    @endif
</div>
