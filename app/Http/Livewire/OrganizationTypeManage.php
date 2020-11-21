<?php

namespace App\Http\Livewire;

use App\Models\OrganizationType;

class OrganizationTypeManage extends NameTypeForm
{
    protected $view = 'livewire.organization-type-manager';

    protected $title = 'Manage Organization Types';

    protected $modelClass = OrganizationType::class;
}
