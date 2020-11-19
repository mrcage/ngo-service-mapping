<?php

namespace App\Http\Livewire;

use App\Actions\UpdateOrganization;
use App\Models\Organization;

class OrganizationEditExternal extends PageComponent
{
    protected $view = 'livewire.organization-edit-external';

    protected function title()
    {
        return $this->organization->name . ' | Edit your Organization';
    }

    public Organization $organization;

    protected $listeners = ['formSubmitted'];

    public function formSubmitted($formData, array $checkedSectors, UpdateOrganization $action)
    {
        $action->update($this->organization, $formData, $checkedSectors);

        session()->flash('message', 'Organization successfully updated.');

        return redirect()->route('organizations.show', $this->organization);
    }
}
