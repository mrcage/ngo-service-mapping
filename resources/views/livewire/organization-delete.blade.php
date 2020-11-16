<div>
    <h2>Delete Organization</h2>
    <form wire:submit.prevent="submit">
        @csrf
        <p>
            Should the organization <strong>{{ $organization->name }}</strong> really be removed?
        </p>
        <p class="d-flex justify-content-between align-items-center">
            <span class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-danger">Delete</button>
                <span wire:loading wire:target="submit" class="ml-2">Deleting...</span>
            </span>
            <a href="{{ route('organizations.show', $organization) }}">Cancel</a>
        </p>
    </form>
</div>
