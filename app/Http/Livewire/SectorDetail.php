<?php

namespace App\Http\Livewire;

use App\Models\Sector;

class SectorDetail extends PageComponent
{
    protected $view = 'livewire.sector-detail';

    protected function title()
    {
        return $this->sector->name . ' | Sector';
    }

    public Sector $sector;
}
