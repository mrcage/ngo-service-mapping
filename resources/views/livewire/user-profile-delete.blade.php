<div>
    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
        <a href="{{ route('home') }}" class="btn btn-primary">Go to overview</a>
    @else
        <form wire:submit.prevent="submit">
            <p>Do you really want do delete your account and all related data?</p>
            <div class="d-flex justify-content-between">
                <span class="d-flex align-items-center">
                    <button type="submit" class="btn btn-danger">
                        <span wire:loading wire:target="submit">Processing...</span>
                        <span wire:loading.remove wire:target="submit">Delete</span>
                    </button>
                    <a
                        wire:loading.remove
                        wire:target="submit"
                        href="{{ route('user-profile-information') }}"
                        class="btn btn-secondary ml-2">
                        Cancel
                    </a>
                </span>
            </div>
        </form>
    @endif
</div>
