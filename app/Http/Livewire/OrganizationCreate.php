<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrganizationCreate extends OrganizationManage
{
    use AuthorizesRequests;

    protected $view = 'livewire.organization-create';

    protected $title = 'Register Organization';

    public function mount()
    {
        $this->authorize('create', Organization::class);

        $this->organization = new Organization();

        parent::mount();
    }

    public function submit()
    {
        parent::submit();

        session()->flash('message', 'Organization successfully registered.');

        return redirect()->route('organizations.show', $this->organization);
    }
}
