<div>
    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
    @endif
    <form wire:submit.prevent="submit">
        <div class="card my-3">
            <div class="card-body pb-0">
                <h5 class="card-title">Profile information</h5>
                <div class="form-group">
                    <label for="inputName">Name:</label>
                    <input
                        type="text"
                        wire:model="name"
                        id="inputName"
                        class="form-control @error('name') is-invalid @enderror"
                        required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="inputEmail">E-mail address:</label>
                    <div class="input-group">
                        <input
                            type="text"
                            wire:model="email"
                            id="inputEmail"
                            class="form-control @error('email') is-invalid @enderror"
                            required>
                        <div class="input-group-append">
                            @isset($user->email_verified_at)
                                <span class="input-group-text text-success">
                                    <x-bi-check-circle class="mr-1"/> Verified
                                </span>
                            @else
                                <span class="input-group-text text-danger">
                                    <x-bi-exclamation-circle class="mr-1"/> Not verified
                                </span>
                            @endisset
                        </div>
                    </div>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
