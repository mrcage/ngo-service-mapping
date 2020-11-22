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
}
