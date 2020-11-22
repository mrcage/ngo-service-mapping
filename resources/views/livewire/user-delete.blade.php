<div>
    <h2>Delete User</h2>
    <form wire:submit.prevent="submit">
        @csrf
        <p>
            Should the user <strong>{{ $user->name }}</strong> really be removed?
        </p>
        <p class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-danger">
                <span wire:loading wire:target="submit">Deleting...</span>
                <span wire:loading.remove wire:target="submit">Delete</span>
            </button>
            <a href="{{ route('users.show', $user) }}">Cancel</a>
        </p>
    </form>
</div>
