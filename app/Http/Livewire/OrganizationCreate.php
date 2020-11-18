<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use App\Models\Sector;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrganizationCreate extends PageComponent
{
    use AuthorizesRequests;

    protected $view = 'livewire.organization-create';

    protected $title = 'Register Organization';

    public Organization $organization;

    protected $listeners = ['formSubmitted'];

    public function mount()
    {
        $this->authorize('create', Organization::class);

        $this->organization = new Organization();
    }

    public function formSubmitted($organization, array $checkedSectors)
    {
        $this->organization->fill($organization);
        $this->organization->save();
        $this->organization->sectors()->sync(Sector::whereIn('slug', $checkedSectors)->get());

        session()->flash('message', 'Organization successfully registered.');

        return redirect()->route('organizations.show', $this->organization);
    }
}
