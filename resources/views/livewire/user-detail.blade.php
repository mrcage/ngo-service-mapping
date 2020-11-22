<div>
    <h2>{{ $user->name }}</h2>

    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif

    @if($user->is_admin)
        <x-alert type="info" message="This is an administrator account."/>
    @endif

    <p>
        <x-bi-envelope-fill/>
        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
        @if($user->hasVerifiedEmail())
            <span class="text-success ml-2" title="{{ $user->email_verified_at->toUserTimezone() }}">
                <x-bi-check-circle/> Verified
            </span>
        @else
            <span class="text-danger ml-2">
                <x-bi-exclamation-circle/> Not verified
            </span>
        @endif
    </p>

    <p title="{{ $user->created_at->toUserTimezone() }}">
        <x-bi-calendar-plus/>
        Registered {{ $user->created_at->diffForHumans() }}
    </p>

    @isset($user->timezone)
        <p>
            <x-bi-watch/>
            {{ str_replace('_', ' ', $user->timezone) }}
        </p>
    @endisset

    @isset($user->last_login_at)
        <h3>Last login</h3>
        <ul>
            <li title="{{ $user->last_login_at->toUserTimezone() }}">
                <x-bi-clock/>
                {{ $user->last_login_at->diffForHumans() }}
            </li>
            @isset($user->last_login_ip)
                <li>
                    <x-bi-globe/>
                    {{ $user->last_login_ip }}
                    <button
                        class="btn btn-sm btn-secondary"
                        wire:click="fetchIpData"
                        aria-label="Query IP data"
                    >
                        <span
                            wire:loading
                            wire:target="fetchIpData"
                            class="spinner-border spinner-border-sm"
                            role="status"
                            aria-hidden="true"></span>
                        <span
                            wire:loading.remove
                            wire:target="fetchIpData"><x-bi-info-circle/></span>
                    </button>
                    @if(count($ipData) > 0)
                        <ul>
                            @foreach($ipData as $k => $v)
                                <li><strong>{{ ucfirst(str_replace('_', ' ', $k)) }}:</strong> {{ $v }}</li>
                            @endforeach
                        </ul>
                    @endisset
                </li>
            @endisset
            @isset($user->last_login_user_agent)
                <li title="{{ $user->last_login_user_agent }}">
                    <x-bi-app/>
                    @php
                        $parser = new donatj\UserAgent\UserAgentParser();
                        $ua = $parser->parse($user->last_login_user_agent);
                    @endphp
                    {{ $ua->browser() }} {{ $ua->browserVersion() }} on {{ $ua->platform() }}
                </li>
            @endisset
        </ul>
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
