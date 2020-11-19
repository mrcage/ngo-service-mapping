<?php

namespace App\Http\Livewire;

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

    public function formSubmitted($organization, array $checkedSectors)
    {
        $this->organization->fill($organization);
        $this->organization->type()->associate($organization['type_id']);
        $this->organization->save();
        $this->organization->sectors()->sync(Sector::whereIn('slug', $checkedSectors)->get());

        session()->flash('message', 'Organization successfully registered.');

        return redirect()->route('organizations.show', $this->organization);
    }
}
