<div>
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
              class="form-control @error('organization.name') is-invalid @enderror">
            @error('organization.name') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
              wire:model.defer="organization.email"
              autocomplete="off"
              class="form-control @error('organization.email') is-invalid @enderror">
              @error('organization.email') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
