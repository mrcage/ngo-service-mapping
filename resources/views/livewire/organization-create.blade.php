<div>
    <h2>Register Organization</h2>
    <div wire:loading.remove>
        <livewire:organization-edit-form
            :organization="$organization"
            :cancel-url="route('organizations.index')">
    </div>
    <p wire:loading>Registering...</p>
</div>
