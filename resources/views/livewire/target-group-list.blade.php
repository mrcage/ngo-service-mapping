<div>
    <div class="d-sm-flex justify-content-between align-items-center">
        <h2>Target Groups</h2>
        @can('create', App\Model\TargetGroup::class)
            <a href="{{ route('target-groups.manage') }}">Manage target groups</a>
        @endcan
    </div>
    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif
    @if($targetGroups->isNotEmpty())
        <div class="list-group mt-3">
            @foreach ($targetGroups as $targetGroup)
                <a href="{{  route('target-groups.show', $targetGroup) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>{{ $targetGroup->name }}</span>
                    <small>{{ $targetGroup->services->count() }} services</small>
                </a>
            @endforeach
        </div>
    @else
        <x-alert type="info" message="No target groups covered or assigned to services."/>
    @endif
</div>
