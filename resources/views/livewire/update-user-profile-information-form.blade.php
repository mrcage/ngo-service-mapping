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
                    <input
                        type="text"
                        wire:model="email"
                        id="inputEmail"
                        class="form-control @error('email') is-invalid @enderror"
                        required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
