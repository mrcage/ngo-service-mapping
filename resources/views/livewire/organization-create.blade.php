<div>
    <h2>Register Organization</h2>
    <form wire:submit.prevent="submit">
        @csrf
        <p>
            <label for="name">Name:</label>
            <input type="text" id="name" required wire:model.defer="organization.name" autocomplete="off">
            @error('organization.name') <span class="error">{{ $message }}</span> @enderror
        </p>
        <p>
            <label for="description">Description:</label>
            <textarea  id="description" wire:model.defer="organization.description"></textarea>
            @error('organization.description') <span class="error">{{ $message }}</span> @enderror
        </p>
        <p>
            <label for="email">E-Mail address:</label>
            <input type="email" id="email" wire:model.defer="organization.email" autocomplete="off">
            @error('organization.email') <span class="error">{{ $message }}</span> @enderror
        </p>
        <p>
            <button type="submit">Save</button>
        </p>
    </form>
    <p wire:loading wire:target="submit">
        Registering data...
    </p>
    <p>
        <a href="{{ route('organizations.index') }}">Cancel</a>
    </p>
</div>
