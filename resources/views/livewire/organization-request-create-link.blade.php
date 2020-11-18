<div>
    <h2>Request permission to register your organization</h2>
    <p>
        In order to verify your organization's e-mail address, we will send a secure link to your mailbox.
        Click on this link in the e-mail to open a form which allows you to register the data of your organization.
    </p>
    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
        <p><a href="{{ route('organizations.index') }}">Back to list of organizations</a></p>
    @else
        <form wire:submit.prevent="submit">
            @csrf

            <div class="form-group">
                <label for="email">E-Mail address of your organization:</label>
                <input
                  type="email"
                  id="email"
                  wire:model.defer="email"
                  autocomplete="off"
                  class="form-control @error('email') is-invalid @enderror">
                  @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <p class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary">
                    <span wire:loading wire:target="submit">Processing...</span>
                    <span wire:loading.remove wire:target="submit">Send e-mail</span>
                </button>
                <a href="{{ route('organizations.index') }}">Cancel</a>
            </p>
        </form>
    @endif
</div>
