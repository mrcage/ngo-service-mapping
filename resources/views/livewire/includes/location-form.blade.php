<div>
    <form wire:submit.prevent="submit">
        @csrf

        <div class="form-group">
            <label for="name">Name:</label>
            <input
                type="text"
                id="name"
                required
                wire:model.defer="location.name"
                autocomplete="off"
                @unless($location->name) autofocus @endunless
                class="form-control @error('location.name') is-invalid @enderror">
            @error('location.name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea
                id="description"
                wire:model.defer="location.description"
                rows="6"
                class="form-control @error('location.description') is-invalid @enderror"
                ></textarea>
            @error('location.description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="latitude">Coordinates:</label>
            <div class="input-group">
                <input
                    type="text"
                    id="latitude"
                    wire:model.lazy="location.latitude"
                    autocomplete="off"
                    aria-label="Latitude"
                    placeholder="Latitude"
                    class="form-control @error('location.latitude') is-invalid @enderror">
                <input
                    type="text"
                    id="longitude"
                    wire:model.lazy="location.longitude"
                    autocomplete="off"
                    aria-label="Longitude"
                    placeholder="Longitude"
                    class="form-control @error('location.longitude') is-invalid @enderror">
                <div class="input-group-append">
                    <button
                        class="btn btn-outline-secondary"
                        type="button"
                        title="Detect"
                        wire:click="detectLocation">
                        <span
                            wire:loading
                            wire:target="detectLocation"
                            class="spinner-border spinner-border-sm"
                            role="status"
                            aria-hidden="true"></span>
                        <span
                            wire:loading.remove
                            wire:target="detectLocation"><x-bi-geo-alt/></span>
                    </button>
                </div>
                @if(isset($location->latitude) && isset($location->longitude))
                    <div class="input-group-append">
                        <a
                          href="{{ route('locations.map', ['coordinates' => $location->coordinates]) }}"
                          class="btn btn-outline-secondary"
                          target="_blank"
                          title="Open map">
                            <x-bi-map/>
                        </a>
                    </div>
                @endif
                @error('location.latitude') <div class="invalid-feedback">{{ $message }}</div> @enderror
                @error('location.longitude') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <p class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary">
                <span wire:loading wire:target="submit">Saving...</span>
                <span wire:loading.remove wire:target="submit">Save</span>
            </button>
            <a href="{{ $cancelUrl }}">Cancel</a>
        </p>
    </form>
</div>
