<div>
    @auth
        @unless(Auth::user()->hasVerifiedEmail())
            @if (session()->has('verificationSentMessage'))
                <x-alert type="success" :message="session('verificationSentMessage')"/>
            @endif
            <x-alert type="info" message="Your e-mail address still needs to be verified."/>
            <p>
                <button
                    type="button"
                    class="btn btn-primary"
                    wire:click="sendEmailVerificationNotification"
                >
                    <span wire:loading wire:target="sendEmailVerificationNotification">Sending...</span>
                    <span wire:loading.remove wire:target="sendEmailVerificationNotification">Send verification link again</span>
                </button>
            </p>
        @endunless
    @endauth
</div>
