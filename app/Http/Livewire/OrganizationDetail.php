<?php

namespace App\Http\Livewire;

use App\Models\Organization;

class OrganizationDetail extends PageComponent
{
    protected $view = 'livewire.organization-detail';

    protected function title()
    {
        return $this->organization->name . ' | Organization';
    }

    public Organization $organization;

    public string $tab;

    public function mount()
    {
        $this->tab = session()->get('organizations.detail.tab', 'sectors');
    }

    public function updatedTab($value)
    {
        session()->put('organizations.detail.tab', $value);
    }
}
