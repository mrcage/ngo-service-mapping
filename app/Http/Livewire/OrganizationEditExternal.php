<?php

namespace App\Http\Livewire;

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

    public function formSubmitted($organization)
    {
        $this->organization->fill($organization);
        $this->organization->save();

        session()->flash('message', 'Organization successfully updated.');

        return redirect()->route('organizations.show', $this->organization);
    }
}
