<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrganizationDelete extends PageComponent
{
    use AuthorizesRequests;

    protected $view = 'livewire.organization-delete';

    protected function title()
    {
        return $this->organization->name . ' | Delete Organization';
    }

    public Organization $organization;

    public function mount()
    {
        $this->authorize('delete', $this->organization);
    }

    public function submit()
    {
        $this->organization->delete();

        session()->flash('message', 'Organization successfully deleted.');

        return redirect()->route('organizations.index');
    }
}
