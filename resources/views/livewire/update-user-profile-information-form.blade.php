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
                        wire:model.defer="name"
                        id="inputName"
                        required
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
                            class="form-control @error('email') is-invalid @enderror"
                        >
                        <div class="input-group-append">
                            @if($user->isEmailVerified)
                                <span class="input-group-text text-success">
                                    <x-bi-check-circle class="mr-1"/> Verified
                                </span>
                            @else
                                <span class="input-group-text text-danger">
                                    <x-bi-exclamation-circle class="mr-1"/> Not verified
                                </span>
                            @endif
                        </div>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
