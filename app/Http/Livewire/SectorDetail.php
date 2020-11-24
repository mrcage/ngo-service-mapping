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

    public string $tab;

    public function mount()
    {
        $this->tab = session()->get('sector.detail.tab', 'services');
    }

    public function updatedTab($value)
    {
        session()->put('sector.detail.tab', $value);
    }
}
