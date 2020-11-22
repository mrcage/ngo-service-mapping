<div>
    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif
    <form wire:submit.prevent="submit" autocomplete="off">
        <div class="card my-3">
            <div class="card-body pb-0">
                <h5 class="card-title">Profile information</h5>
                <div class="form-group">
                    <label for="inputName">Name:</label>
                    <input
                        type="text"
                        wire:model.defer="name"
                        id="inputName"
                        required
                        autocomplete="off"
                        class="form-control @error('name') is-invalid @enderror"
                    >
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="inputEmail">E-mail address:</label>
                    <div class="input-group">
                        <input
                            type="email"
                            wire:model.defer="email"
                            id="inputEmail"
                            required
                            autocomplete="off"
                            class="form-control @error('email') is-invalid @enderror"
                        >
                        <div class="input-group-append">
                            @if($user->hasVerifiedEmail())
                                <span class="input-group-text text-success">
                                    <x-bi-unlock class="mr-1"/>
                                    <span class="d-none d-sm-inline">Verified</span>
                                </span>
                            @else
                                <span class="input-group-text text-danger">
                                    <x-bi-lock class="mr-1"/>
                                    <span class="d-none d-sm-inline">Not verified</span>
                                </span>
                            @endif
                        </div>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="timezone">Timezone:</label>
                    <div class="input-group mb-3">
                        <select
                            id="timezone"
                            wire:model.defer="timezone"
                            class="custom-select @error('timezone') is-invalid @enderror">
                            <option value="">- Default timezone -</option>
                            @foreach($timezones as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button
                                class="btn btn-outline-secondary"
                                type="button"
                                wire:click="detectTimezone">
                                <span
                                    wire:loading
                                    wire:target="detectTimezone"
                                    class="spinner-border spinner-border-sm"
                                    role="status"
                                    aria-hidden="true"></span>
                                <span
                                    wire:loading.remove
                                    wire:target="detectTimezone"><x-bi-geo-alt/></span>
                            </button>
                        </div>
                        @error('timezone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <span wire:loading wire:target="submit">Saving changes...</span>
                    <span wire:loading.remove wire:target="submit">Save</span>
                </button>
            </div>
        </div>
    </form>
</div>
