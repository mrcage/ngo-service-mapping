<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrganizationEdit extends OrganizationManage
{
    use AuthorizesRequests;

    protected $view = 'livewire.organization-edit';

    protected function title()
    {
        return $this->organization->name . ' | Edit Organization';
    }

    public function mount()
    {
        $this->authorize('update', $this->organization);

        parent::mount();
    }

    public function submit()
    {
        parent::submit();

        session()->flash('message', 'Organization successfully updated.');

        return redirect()->route('organizations.show', $this->organization);
    }
}
