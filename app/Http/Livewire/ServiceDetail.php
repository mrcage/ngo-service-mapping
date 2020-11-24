<?php

namespace App\Http\Livewire;

use App\Models\Service;

class ServiceDetail extends PageComponent
{
    protected $view = 'livewire.service-detail';

    protected function title()
    {
        return $this->service->name . ' | Service';
    }

    public Service $service;
}
