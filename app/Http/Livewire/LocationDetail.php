<?php

namespace App\Http\Livewire;

use App\Models\Location;

class LocationDetail extends PageComponent
{
    protected $view = 'livewire.location-detail';

    protected function title()
    {
        return $this->location->name . ' | Location';
    }

    public Location $location;

    public string $tab;

    public function mount()
    {
        $this->tab = session()->get('locations.detail.tab', 'sectors');
    }

    public function updatedTab($value)
    {
        session()->put('locations.detail.tab', $value);
    }
}
