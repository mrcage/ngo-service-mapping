<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrganizationEdit extends PageComponent
{
    use AuthorizesRequests;

    protected $view = 'livewire.organization-edit';

    protected function title()
    {
        return $this->organization->name . ' | Edit Organization';
    }

    public Organization $organization;

    protected $listeners = ['formSubmitted'];

    public function mount()
    {
        $this->authorize('update', $this->organization);
    }

    public function formSubmitted($organization)
    {
        $this->organization->fill($organization);
        $this->organization->save();

        session()->flash('message', 'Organization successfully updated.');

        return redirect()->route('organizations.show', $this->organization);
    }
}
