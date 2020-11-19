<?php

namespace App\Http\Livewire;

use App\Models\Sector;

class SectorList extends PageComponent
{
    protected $view = 'livewire.sector-list';

    protected $title = 'Sectors';

    public $sectors;

    public function mount()
    {
        $this->sectors = Sector::query()
            ->has('organizations')
            ->orderBy('name')
            ->get();
    }
}
