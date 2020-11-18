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
}
