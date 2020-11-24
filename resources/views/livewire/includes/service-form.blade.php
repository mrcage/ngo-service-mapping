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
            @isset($location)
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
            @elseif ($organization)
                <div class="form-group">
                    <label for="location">Location:</label>
                    <select
                        id="location"
                        wire:model.defer="service.location_id"
                        required
                        class="custom-select @error('service.location_id') is-invalid @enderror">
                        <option value="">- Select location -</option>
                        @foreach(App\Models\Location::orderBy('name')->get() as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                    @error('service.location_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            @endisset
        @endunless

        <div class="form-group">
            <label for="sector">Sector:</label>
            <select
                id="sector"
                wire:model.defer="service.sector_id"
                class="custom-select @error('service.sector_id') is-invalid @enderror">
                <option value="">- Select sector -</option>
                @foreach($sectors as $sector)
                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                @endforeach
            </select>
            @error('service.sector_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

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

        @if($targetGroups->isNotEmpty())
            <p class="mb-2">Target groups:</p>
            <div class="mb-3">
                @foreach($targetGroups as $targetGroup)
                    <div class="custom-control custom-checkbox">
                        <input
                            type="checkbox"
                            class="custom-control-input"
                            id="targetGroup-{{ $targetGroup->getRouteKey() }}"
                            value="{{ $targetGroup->slug }}"
                            wire:model.defer="checkedTargetGroups"
                        >
                        <label class="custom-control-label" for="targetGroup-{{ $targetGroup->getRouteKey() }}">{{ $targetGroup->name }} </label>
                    </div>
                @endforeach
            </div>
        @endif

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
