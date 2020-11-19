<div>
    <h2>Sectors</h2>
    @if($sectors->isNotEmpty())
        <div class="list-group mt-3">
            @foreach ($sectors as $sector)
                <a href="{{  route('sectors.show', $sector) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>{{ $sector->name }}</span>
                    <small>{{ $sector->organizations->count() }} organizations</small>
                </a>
            @endforeach
        </div>
    @else
        <x-alert type="info" message="No sectors registered."/>
    @endif
</div>
