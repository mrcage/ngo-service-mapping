<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Livewire\WithPagination;

class OrganizationChanges extends PageComponent
{
    use WithPagination;

    protected $view = 'livewire.organization-changes';

    protected function title()
    {
        return $this->organization->name . ' | Changes of Organization';
    }

    public Organization $organization;

    protected $paginationTheme = 'bootstrap';
}
