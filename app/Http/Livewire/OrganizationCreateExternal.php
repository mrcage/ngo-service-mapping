<?php

namespace App\Http\Livewire;

use App\Actions\UpdateOrganization;
use App\Models\Organization;
use App\Models\Sector;

class OrganizationCreateExternal extends PageComponent
{
    protected $view = 'livewire.organization-create-external';

    protected $title = 'Register your Organization';

    public Organization $organization;

    public string $email;

    protected $listeners = ['formSubmitted'];

    public function mount()
    {
        $this->organization = new Organization();
        $this->organization->email = $this->email;
    }

    public function formSubmitted($formData, array $checkedSectors, UpdateOrganization $action)
    {
        $action->update($this->organization, $formData, $checkedSectors);

        session()->flash('message', 'Organization successfully registered.');

        return redirect()->route('organizations.show', $this->organization);
    }
}
