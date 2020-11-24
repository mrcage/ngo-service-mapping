<div>
    <h2>Delete Service</h2>
    <p>
        <x-bi-diagram-2/> {{ $service->organization->name }}<br>
        <x-bi-geo-alt/> {{ $service->location->name }}
    </p>
    <form wire:submit.prevent="submit">
        @csrf
        <p>
            Should the service <strong>{{ $service->name }}</strong> really be removed?
        </p>
        <p class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-danger">
                <span wire:loading wire:target="submit">Deleting...</span>
                <span wire:loading.remove wire:target="submit">Delete</span>
            </button>
            <a href="{{ $cancelUrl }}">Cancel</a>
        </p>
    </form>
</div>
