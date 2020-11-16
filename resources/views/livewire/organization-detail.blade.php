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
    @markdown($organization->description)
    <p>
        <a href="{{ route('organizations.edit', $organization) }}">Edit</a> |
        <a href="{{ route('organizations.delete', $organization) }}">Delete</a> |
        <a href="{{ route('organizations.index') }}">Return to list</a>
    </p>
</div>
