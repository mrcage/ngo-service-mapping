<div>
    @if($types->isEmpty())
        <x-alert type="danger" message="Please define organization types before registering / editing organizations."/>
    @else
        <form wire:submit.prevent="submit">
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input
                type="text"
                id="name"
                required
                wire:model.defer="organization.name"
                autocomplete="off"
                @unless($organization->name) autofocus @endunless
                class="form-control @error('organization.name') is-invalid @enderror">
                @error('organization.name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="type">Type:</label>
                <select
                    id="type"
                    wire:model.defer="organization.type_id"
                    required
                    class="custom-select @error('organization.type_id') is-invalid @enderror">
                    <option value="">- Select type -</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('organization.type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea
                id="description"
                wire:model.defer="organization.description"
                rows="6"
                class="form-control @error('organization.description') is-invalid @enderror"
                ></textarea>
                @error('organization.description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email">E-Mail address:</label>
                <input
                type="email"
                id="email"
                autocomplete="off"
                @if($disableEmail) disabled value="{{ $organization->email }}"
                @else wire:model.defer="organization.email"
                @endif
                class="form-control @error('organization.email') is-invalid @enderror">
                @error('organization.email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="website">Website:</label>
                <input
                type="url"
                id="website"
                wire:model.defer="organization.website"
                autocomplete="off"
                class="form-control @error('organization.website') is-invalid @enderror">
                @error('organization.website') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <p class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary">
                    <span wire:loading wire:target="submit">Saving...</span>
                    <span wire:loading.remove wire:target="submit">Save</span>
                </button>
                <a href="{{ $cancelUrl }}">Cancel</a>
            </p>
        </form>
    @endif
</div>