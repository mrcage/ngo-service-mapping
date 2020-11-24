<div>
    <h2>Delete Location</h2>
    <form wire:submit.prevent="submit">
        @csrf
        <p>
            Should the location <strong>{{ $location->name }}</strong> really be removed?
        </p>
        <p class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-danger">
                <span wire:loading wire:target="submit">Deleting...</span>
                <span wire:loading.remove wire:target="submit">Delete</span>
            </button>
            <a href="{{ route('locations.show', $location) }}">Cancel</a>
        </p>
    </form>
</div>
