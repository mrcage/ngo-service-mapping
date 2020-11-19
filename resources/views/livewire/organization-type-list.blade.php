<div>
    <h2>Organization Types</h2>
    @if($types->isNotEmpty())
        <div class="list-group mt-3">
            @foreach ($types as $type)
                <a href="{{  route('types.show', $type) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>{{ $type->name }}</span>
                    <small>{{ $type->organizations->count() }} organizations</small>
                </a>
            @endforeach
        </div>
    @else
        <x-alert type="info" message="No types registered."/>
    @endif
</div>
