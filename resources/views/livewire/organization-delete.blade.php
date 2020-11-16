<div>
    <h2>Delete Organization</h2>
    <form wire:submit.prevent="submit">
        @csrf
        <p>Should the organization <strong>{{ $organization->name }}</strong> really be removed?</p>
        <p>
            <button type="submit">Delete</button>
        </p>
    </form>
    <p wire:loading wire:target="submit">
        Deleting...
    </p>
    <p>
        <a href="{{ route('organizations.show', $organization) }}">Cancel</a>
    </p>
</div>
