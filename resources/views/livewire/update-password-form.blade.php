<div>
    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif
    <form wire:submit.prevent="submit">
        <div class="card my-3">
            <div class="card-body pb-0">
                <h5 class="card-title">Password update</h5>
                <div class="form-group">
                    <label for="inputCurrentPassword">Current password</label>
                    <input
                        type="password"
                        wire:model.lazy="currentPassword"
                        id="inputCurrentPassword"
                        class="form-control @error('current_password') is-invalid @enderror"
                        required
                        autocomplete="off">
                    @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="inputPassword">New password:</label>
                    <input
                        type="password"
                        wire:model.lazy="password"
                        id="inputPassword"
                        class="form-control @error('password') is-invalid @enderror"
                        required
                        autocomplete="off">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="inputPasswordConfirmation">Confirm password:</label>
                    <input
                        type="password"
                        wire:model.lazy="passwordConfirmation"
                        id="inputPasswordConfirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        required
                        autocomplete="off">
                    @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="card-footer">
                <span class="d-flex align-items-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <span wire:loading wire:target="submit" class="ml-2">Saving changes...</span>
                </span>
            </div>
        </div>
    </form>
</div>
