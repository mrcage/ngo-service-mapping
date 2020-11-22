<?php

namespace App\Http\Livewire;

use App\Models\Organization;

class OrganizationCreateExternal extends OrganizationManage
{
    protected $view = 'livewire.organization-create-external';

    protected $title = 'Register your Organization';

    public string $email;

    public bool $disableEmail = true;

    public function mount()
    {
        $this->organization = new Organization();
        $this->organization->email = $this->email;

        parent::mount();
    }

    public function submit()
    {
        parent::submit();

        session()->flash('message', 'Organization successfully registered.');

        return redirect()->route('organizations.show', $this->organization);
    }
}
