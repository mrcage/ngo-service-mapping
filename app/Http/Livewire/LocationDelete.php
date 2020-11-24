<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LocationDelete extends PageComponent
{
    use AuthorizesRequests;

    protected $view = 'livewire.location-delete';

    protected function title()
    {
        return $this->location->name . ' | Delete Location';
    }

    public Location $location;

    public function mount()
    {
        $this->authorize('delete', $this->location);
    }

    public function submit()
    {
        $this->location->delete();

        session()->flash('message', 'Location successfully deleted.');

        return redirect()->route('locations.index');
    }
}
