<?php

namespace App\Http\Livewire;

use App\Models\OrganizationType;

class OrganizationTypeDetail extends PageComponent
{
    protected $view = 'livewire.organization-type-detail';

    protected function title()
    {
        return $this->type->name . ' | Organization Type';
    }

    public OrganizationType $type;
}
