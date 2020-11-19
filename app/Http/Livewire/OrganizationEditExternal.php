<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use App\Models\Sector;

class OrganizationEditExternal extends PageComponent
{
    protected $view = 'livewire.organization-edit-external';

    protected function title()
    {
        return $this->organization->name . ' | Edit your Organization';
    }

    public Organization $organization;

    protected $listeners = ['formSubmitted'];

    public function formSubmitted($organization, array $checkedSectors)
    {
        $this->organization->fill($organization);
        $this->organization->type()->associate($organization['type_id']);
        $this->organization->save();
        $this->organization->sectors()->sync(Sector::whereIn('slug', $checkedSectors)->get());

        session()->flash('message', 'Organization successfully updated.');

        return redirect()->route('organizations.show', $this->organization);
    }
}
