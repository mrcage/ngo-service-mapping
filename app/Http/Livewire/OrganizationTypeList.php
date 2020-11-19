<?php

namespace App\Http\Livewire;

use App\Models\OrganizationType;

class OrganizationTypeList extends PageComponent
{
    protected $view = 'livewire.organization-type-list';

    protected $title = 'Organization Types';

    public $types;

    public function mount()
    {
        $this->types = OrganizationType::query()
            ->has('organizations')
            ->orderBy('name')
            ->get();
    }
}
