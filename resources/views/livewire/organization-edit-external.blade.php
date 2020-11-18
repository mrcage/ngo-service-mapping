<div>
    <h2>Edit your Organization</h2>
    <div wire:loading.remove>
        <livewire:organization-edit-form
            :organization="$organization"
            :cancel-url="route('organizations.show', $organization)">
    </div>
    <p wire:loading>Saving changes...</p>
</div>
