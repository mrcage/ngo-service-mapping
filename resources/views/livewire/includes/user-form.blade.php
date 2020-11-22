<form wire:submit.prevent="submit" autocomplete="off">
    <div class="form-group">
        <label for="inputName">Name:</label>
        <input
            type="text"
            wire:model.defer="user.name"
            id="inputName"
            required
            autocomplete="off"
            @unless($user->exists) autofocus @endunless
            class="form-control @error('user.name') is-invalid @enderror"
        >
        @error('user.name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
        <label for="inputEmail">E-mail address:</label>
        <input
            type="email"
            wire:model.defer="user.email"
            id="inputEmail"
            required
            autocomplete="off"
            class="form-control @error('user.email') is-invalid @enderror"
        >
        @error('user.email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <p>
        <div class="custom-control custom-switch">
            <input
                type="checkbox"
                class="custom-control-input"
                id="customSwitch1"
                value="1"
                wire:model="isEmailVerified"
            >
            <label class="custom-control-label" for="customSwitch1">Verified E-Mail address</label>
        </div>
    </p>
    <div class="form-group">
        <label for="inputPassword">@if($user->exists) New password: @else Password: @endif</label>
        <input
            type="password"
            wire:model.defer="password"
            id="inputPassword"
            class="form-control @error('password') is-invalid @enderror"
            @unless($user->exists) required @endunless
            @if($user->exists) placeholder="(Leave empty if you don't want to change it)" @endif
        >
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <p class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary">
            <span wire:loading wire:target="submit">Saving...</span>
            <span wire:loading.remove wire:target="submit">Save</span>
        </button>
        <a href="{{ $cancelUrl }}">Cancel</a>
    </p>
</form>
