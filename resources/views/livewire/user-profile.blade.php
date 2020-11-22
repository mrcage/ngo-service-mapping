<div>
    <h2>User profile</h2>
    @if($user->is_admin)
        <x-alert type="info" message="This is an administrator account."/>
    @endif
    <livewire:update-user-profile-information-form :user="$user">
    <livewire:update-password-form :user="$user">
    <div>
        <div class="card my-3">
            <div class="card-body">
                <h5 class="card-title">Account settings</h5>
                <a href="{{ route('user-profile-delete') }}" class="btn btn-danger">Delete account</a>
            </div>
        </div>
    </div>
    <p class="text-center">
        <a href="{{ route('home') }}">Return to overview</a>
    </p>
</div>
