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
                id="emailVerifiedSwitch"
                value="1"
                wire:model="isEmailVerified"
            >
            <label class="custom-control-label" for="emailVerifiedSwitch">Verified E-Mail address</label>
        </div>
    </p>
    <div class="form-group">
        <label for="inputPassword">@if($user->exists) New password: @else Password: @endif</label>
        <div class="input-group mb-3">
            <input
                @if($showPassword) type="text" @else type="password" @endif
                wire:model.defer="password"
                id="inputPassword"
                class="form-control @error('password') is-invalid @enderror"
                @unless($user->exists) required @endunless
                @if($user->exists) placeholder="(Leave empty if you don't want to change it)" @endif
            >
            <div class="input-group-append">
                <button
                    class="btn btn-outline-secondary"
                    type="button"
                    wire:click="generatePassword">
                    <span
                        wire:loading
                        wire:target="generatePassword"
                        class="spinner-border spinner-border-sm"
                        role="status"
                        aria-hidden="true"></span>
                    <span
                        wire:loading.remove
                        wire:target="generatePassword"><x-bi-arrow-repeat/></span>
                </button>
            </div>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
    <p>
        <div class="custom-control custom-switch">
            <input
                type="checkbox"
                class="custom-control-input"
                id="adminSwitch"
                value="1"
                wire:model.defer="user.is_admin"
                @if($user->is_admin && App\Models\User::where('is_admin', true)->count() == 1) disabled @endif
            >
            <label class="custom-control-label" for="adminSwitch">Administrator</label>
        </div>
    </p>
    <div class="form-group">
        <label for="timezone">Timezone:</label>
        <select
            id="timezone"
            wire:model.defer="user.timezone"
            class="custom-select @error('user-timezone') is-invalid @enderror">
            <option value="">- Default timezone -</option>
            @foreach(listTimezones() as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
        @error('user.timezone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <p class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary">
            <span wire:loading wire:target="submit">Saving...</span>
            <span wire:loading.remove wire:target="submit">Save</span>
        </button>
        <a href="{{ $cancelUrl }}">Cancel</a>
    </p>
</form>
