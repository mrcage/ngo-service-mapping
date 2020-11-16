<div>
    <h2>{{ $organization->name }}</h2>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    @isset($organization->email)
        <p>
            <a href="mailto:{{ $organization->email }}">{{ $organization->email }}</a>
        </p>
    @endisset
    @isset($organization->description)
        @markdown($organization->description)
    @else
        <p><em>No description has been provided.</em></p>
    @endif
    <p>
        <a href="{{ route('organizations.edit', $organization) }}">Edit</a> |
        <a href="{{ route('organizations.delete', $organization) }}">Delete</a> |
        <a href="{{ route('organizations.index') }}">Return to list</a>
    </p>
</div>
