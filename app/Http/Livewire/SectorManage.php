<?php

namespace App\Http\Livewire;

use App\Models\Sector;

class SectorManage extends NameTypeForm
{
    protected $view = 'livewire.sector-manage';

    protected $title = 'Manage Sectors';

    protected $modelClass = Sector::class;
}
