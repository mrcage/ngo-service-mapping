<div>
    <div class="d-sm-flex justify-content-between align-items-center">
        <h2>Users</h2>
        @can('create', App\Model\User::class)
            <a href="{{ route('users.create') }}">Register user</a>
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
    @if(filled($search) && $users->isNotEmpty())
        <p wire:loading.remove>
            <em>Listing {{ $users->count() }} users matching '{{ trim($search) }}':</em>
        </p>
    @endif
    @if($users->isNotEmpty())
        <div class="list-group mb-3">
            @foreach ($users as $user)
                <a href="{{  route('users.show', $user) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>{{ $user->name }}</span>
                    <small class="d-none d-sm-inline text-right">
                        <span class="@if($user->isEmailVerified) text-success @else text-danger  @endif">{{ $user->email }}</span>
                        <br>Registered {{ $user->created_at->diffForHumans() }}
                    </small>
                </a>
            @endforeach
        </div>
        @if(blank($search))
            <p>
                <small>There are {{ $users->count() }} users registered.</small>
            </p>
        @endif
    @else
        <x-alert type="info" message="No users found."/>
    @endif
</div>
