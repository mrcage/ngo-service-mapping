<div>
    <h2>Register your Organization</h2>
    <div wire:loading.remove>
        <livewire:organization-edit-form
            :organization="$organization"
            :cancel-url="route('organizations.index')"
            :disable-email="true">
    </div>
    <p wire:loading>Registering...</p>
    </form>
</div>
