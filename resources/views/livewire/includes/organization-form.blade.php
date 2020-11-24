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
                <label for="abbreviation">Abbreviation:</label>
                <input
                    type="text"
                    id="abbreviation"
                    wire:model.defer="organization.abbreviation"
                    autocomplete="off"
                    maxlength="3"
                    class="form-control @error('organization.abbreviation') is-invalid @enderror">
                @error('organization.abbreviation') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                <label for="phone">Phone:</label>
                <input
                type="tel"
                id="phone"
                autocomplete="off"
                wire:model.defer="organization.phone"
                class="form-control @error('organization.phone') is-invalid @enderror">
                @error('organization.phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
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

            <div class="form-group">
                <label for="facebook">Facebook:</label>
                <input
                type="url"
                id="facebook"
                wire:model.defer="organization.facebook"
                autocomplete="off"
                class="form-control @error('organization.facebook') is-invalid @enderror">
                @error('organization.facebook') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="instagram">Instagram:</label>
                <input
                type="url"
                id="instagram"
                wire:model.defer="organization.instagram"
                autocomplete="off"
                class="form-control @error('organization.instagram') is-invalid @enderror">
                @error('organization.instagram') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="twitter">Twitter:</label>
                <input
                type="url"
                id="twitter"
                wire:model.defer="organization.twitter"
                autocomplete="off"
                class="form-control @error('organization.twitter') is-invalid @enderror">
                @error('organization.twitter') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="youtube">YouTube:</label>
                <input
                type="url"
                id="youtube"
                wire:model.defer="organization.youtube"
                autocomplete="off"
                class="form-control @error('organization.youtube') is-invalid @enderror">
                @error('organization.youtube') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="linkedin">LinkedIn:</label>
                <input
                type="url"
                id="linkedin"
                wire:model.defer="organization.linkedin"
                autocomplete="off"
                class="form-control @error('organization.linkedin') is-invalid @enderror">
                @error('organization.linkedin') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
