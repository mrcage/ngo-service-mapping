<div>
    <h2>
        Changes of organization {{ $organization->name }}
    </h2>
    @if($organization->audits->isNotEmpty())
        @php
            $audits = $organization->audits()->orderBy('created_at', 'desc')->paginate(10);
        @endphp
        @foreach($audits as $audit)
            @php
                $data = $audit->getMetadata();
                $date = (new Carbon\Carbon($data['audit_created_at']));
            @endphp
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">
                        @if($data['audit_event'] == 'created')
                            <x-bi-asterisk class="text-success mr-1"/>
                            Registered organization
                            @php
                                $changed = collect($audit->getModified())->except('id', 'slug', 'type_id')->whereNotNull('new');
                            @endphp
                            @if($changed->isNotEmpty())
                                with
                                @foreach($changed as $k => $v)
                                    {{ ($k) }} <code>{{ Str::of($v['new'])->words(3) }}</code>@unless($loop->last)@if($loop->remaining > 1),@else and @endif @endunless
                                @endforeach
                            @endif
                        @elseif($data['audit_event'] == 'updated')
                            <x-bi-pencil-fill class="text-info mr-1"/>
                            @php
                                $changed = collect($audit->getModified())->except('slug')->whereNotNull('new');
                                $removed = collect($audit->getModified())->whereNull('new');
                            @endphp
                            @if($changed->isNotEmpty())
                                Changed
                                @foreach($changed as $k => $v)
                                    @php
                                        if ($k == 'type_id') {
                                            $val = optional(App\Models\OrganizationType::find($v['new']))->name;
                                            $label = 'type';
                                        } else {
                                            $val = Str::of($v['new'])->words(3);
                                            $label = $k;
                                        }
                                    @endphp
                                    {{ ($label) }} to <code>{{ $val }}</code>@unless($loop->last)@if($loop->remaining > 1),@else and @endif @endunless
                                @endforeach
                            @endif
                            @if($removed->isNotEmpty())
                                @if($changed->isNotEmpty())
                                    and removed
                                @else
                                    Removed
                                @endif
                                @foreach($removed as $k => $v)
                                    {{ $k }}@unless($loop->last)@if($loop->remaining > 1),@else and @endif @endunless
                                @endforeach
                            @endif
                        @elseif($data['audit_event'] == 'deleted')
                            <x-bi-trash-fill class="text-danger mr-1"/>
                            Deleted organization
                        @endif
                    </p>
                    <p class="card-text">
                        <small class="text-muted">
                            <span title="{{ $date->toUserTimezone() }}">{{ $date->diffForHumans() }}</span>
                            @isset($audit->user)
                                by
                                @can('view', $audit->user)
                                    <a href="{{ route('users.show', $audit->user) }}">{{ $audit->user->name }}</a>
                                    from
                                    <span title="{{ $data['audit_user_agent'] }}">
                                        {{ $data['audit_ip_address'] }}
                                    </span>
                                @else
                                    {{ $audit->user->name }}
                                @endcan
                            @endisset
                        </small>
                    </p>
                </div>
            </div>
        @endforeach
        {{ $audits->links() }}
    @else
        <x-alert type="info" message="No changes registered."/>
    @endif
    <p>
        <a href="{{ route('organizations.show', $organization) }}">Return to organization</a>
    </p>
</div>
