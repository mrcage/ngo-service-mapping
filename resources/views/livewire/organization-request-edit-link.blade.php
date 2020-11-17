<div>
    <h2>Request permission to edit your organization <strong>{{ $organization->name }}</strong></h2>
    <p>
        We will send a secure link to your organization's e-mail address <strong>{{ $organization->email }}</strong>.
        Click on this link to open a form which allows you to edit the data of your organization.
    </p>
    @if (session()->has('message'))
        <x-alert type="success" :message="session('message')"/>
        <p><a href="{{ route('organizations.show', $organization) }}">Back to organization</a></p>
    @else
        <form wire:submit.prevent="submit">
            @csrf
            <p class="d-flex justify-content-between align-items-center">
                <span class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">Send e-mail</button>
                    <span wire:loading wire:target="submit" class="ml-2">Processing...</span>
                </span>
                <a href="{{ route('organizations.show', $organization) }}">Cancel</a>
            </p>
        </form>
    @endif
</div>
