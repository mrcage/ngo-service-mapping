<?php

namespace App\Http\Livewire;

class OrganizationEditExternal extends OrganizationManage
{
    protected $view = 'livewire.organization-edit-external';

    protected function title()
    {
        return $this->organization->name . ' | Edit your Organization';
    }

    public function submit()
    {
        parent::submit();

        session()->flash('message', 'Organization successfully updated.');

        return redirect()->route('organizations.show', $this->organization);
    }
}
