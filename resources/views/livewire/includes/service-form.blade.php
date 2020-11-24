<div>
    <p>
        @isset($service->organization)
            <x-bi-diagram-2/> {{ $service->organization->name }}<br>
        @elseif($organization)
            <x-bi-diagram-2/> {{ $organization->name }}<br>
        @endisset
        @isset($service->location)
            <x-bi-geo-alt/> {{ $service->location->name }}
        @elseif($location)
            <x-bi-geo-alt/> {{ $location->name }}
        @endisset
    </p>
    <form wire:submit.prevent="submit">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input
                type="text"
                id="name"
                required
                wire:model.defer="service.name"
                autocomplete="off"
                @unless($service->name) autofocus @endunless
                class="form-control @error('service.name') is-invalid @enderror">
            @error('service.name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        @unless($service->exists)
        <div class="form-group">
            <label for="organization">Organization:</label>
            <select
                id="organization"
                wire:model.defer="service.organization_id"
                required
                class="custom-select @error('service.organization_id') is-invalid @enderror">
                <option value="">- Select organization -</option>
                @foreach(App\Models\Organization::orderBy('name')->get() as $organization)
                    <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                @endforeach
            </select>
            @error('service.organization_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        @endunless

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea
                id="description"
                wire:model.defer="service.description"
                rows="6"
                class="form-control @error('service.description') is-invalid @enderror"
                ></textarea>
            @error('service.description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <p class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary">
                <span wire:loading wire:target="submit">Saving...</span>
                <span wire:loading.remove wire:target="submit">Save</span>
            </button>
            @isset($cancelUrl)
                <a href="{{ $cancelUrl }}">Cancel</a>
            @endisset
        </p>
    </form>
</div>
