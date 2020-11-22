<div>
    <h2>{{ $user->name }}</h2>
    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif
    <p>
        <x-bi-envelope-fill/>
        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
        @if($user->hasVerifiedEmail())
            <span class="text-success ml-2" title="{{ $user->email_verified_at }}">
                <x-bi-check-circle/> Verified
            </span>
        @else
            <span class="text-danger ml-2">
                <x-bi-exclamation-circle/> Not verified
            </span>
        @endif
    </p>
    <p title="{{ $user->created_at }}">
        <x-bi-calendar-plus/>
        Registered {{ $user->created_at->diffForHumans() }}
    </p>
    @isset($user->last_login_at)
        <p>
            <x-bi-door-open/>
            Last login: <span title="{{ $user->last_login_at }}">{{ $user->last_login_at->diffForHumans() }}</span>
            @isset($user->last_login_ip)
                from <a href="https://whatismyipaddress.com/ip/{{ $user->last_login_ip }}" target="_blank">{{ $user->last_login_ip }}</a>
            @endisset
            @isset($user->last_login_user_agent)
                with {{ $user->last_login_user_agent }}
            @endisset
        </p>
    @endisset
    <p>
        @can('update', $user)
            <a href="{{ route('users.edit', $user) }}">Edit</a> |
        @endcan
        @can('delete', $user)
            <a href="{{ route('users.delete', $user) }}">Delete</a> |
        @endcan
        <a href="{{ route('users.index') }}">Return to list of users</a>
    </p>
</div>
