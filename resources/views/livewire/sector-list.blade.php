<div>
    <div class="d-sm-flex justify-content-between align-items-center">
        <h2>Sectors</h2>
        @can('create', App\Model\Sector::class)
            <a href="{{ route('sectors.manage') }}">Manage sectors</a>
        @endcan
    </div>
    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif
    @if($sectors->isNotEmpty())
        <div class="list-group my-3">
            @foreach ($sectors as $sector)
                <a href="{{  route('sectors.show', $sector) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>{{ $sector->name }}</span>
                    <small>{{ $sector->services()->count() }} services</small>
                </a>
            @endforeach
        </div>
        <p><small>There are {{ $sectors->count() }} sectors assigned to any services.</small></p>
    @else
        <x-alert type="info" message="No sectors registered or assigned to services."/>
    @endif
</div>
