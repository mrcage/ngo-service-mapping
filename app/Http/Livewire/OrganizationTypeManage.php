<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrganizationTypeManage extends PageComponent
{
    use AuthorizesRequests;

    protected $view = 'livewire.organization-type-manager';

    protected $title = 'Manage Organization Types';

}
