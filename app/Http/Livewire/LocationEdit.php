<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LocationEdit extends LocationManage
{
    use AuthorizesRequests;

    protected $view = 'livewire.location-edit';

    protected function title()
    {
        return $this->location->name . ' | Edit Location';
    }

    public function mount()
    {
        $this->authorize('update', $this->location);

        parent::mount();
    }

    public function submit()
    {
        parent::submit();

        session()->flash('message', 'Location successfully updated.');

        return redirect()->route('locations.show', $this->location);
    }
}
