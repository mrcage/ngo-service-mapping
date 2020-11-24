<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LocationCreate extends LocationManage
{
    use AuthorizesRequests;

    protected $view = 'livewire.location-create';

    protected $title = 'Register Location';

    public function mount()
    {
        $this->authorize('create', Location::class);

        $this->location = new Location();

        parent::mount();
    }

    public function submit()
    {
        parent::submit();

        session()->flash('message', 'Location successfully registered.');

        return redirect()->route('locations.show', $this->location);
    }
}
