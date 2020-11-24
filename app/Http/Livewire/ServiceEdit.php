<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ServiceEdit extends ServiceManage
{
    use AuthorizesRequests;

    protected $view = 'livewire.service-edit';

    protected function title()
    {
        return $this->service->name . ' | Edit Service';
    }

    public function mount()
    {
        $this->authorize('update', $this->service);

        parent::mount();
    }

    public function submit()
    {
        parent::submit();

        session()->flash('message', 'Service successfully updated.');

        if (isset($this->location)) {
            return redirect()->route('locations.show', $this->location);
        } else if (isset($this->organization)) {
            return redirect()->route('organizations.show', $this->organization);
        }
    }
}
