<?php

namespace App\Http\Livewire;

use App\Models\Location;
use App\Models\Organization;
use App\Models\Service;

abstract class ServiceManage extends PageComponent
{
    public Service $service;

    public Location $location;

    public Organization $organization;

    public string $cancelUrl;

    protected $rules = [
        'service.name' => [
            'filled',
            'string',
            'min:3',
            'max:255',
        ],
        'service.organization_id' => [
            'exists:organizations,id',
        ],
        'service.location_id' => [
            'exists:locations,id',
        ],
        'service.description' => [
            'nullable',
            'min:3',
        ],
    ];

    public function mount()
    {
        if (isset($this->location)) {
            $this->cancelUrl = route('locations.show', $this->location);
        } else if (isset($this->organization)) {
            $this->cancelUrl = route('organizations.show', $this->organization);
        }
    }

    public function submit()
    {
        $this->validate();

        $this->service->save();
    }
}
