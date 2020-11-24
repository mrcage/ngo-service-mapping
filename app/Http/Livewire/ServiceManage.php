<?php

namespace App\Http\Livewire;

use App\Models\Location;
use App\Models\Organization;
use App\Models\Sector;
use App\Models\Service;
use App\Models\TargetGroup;
use Illuminate\Support\Collection;

abstract class ServiceManage extends PageComponent
{
    public Service $service;

    public Location $location;

    public Organization $organization;

    public string $cancelUrl;

    public Collection $sectors;

    public array $checkedTargetGroups;

    public Collection $targetGroups;

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
        'service.sector_id' => [
            'exists:sectors,id',
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

        $this->sectors = Sector::orderBy('name')->get();

        $this->checkedTargetGroups = $this->service->targetGroups->pluck('slug')->toArray();
        $this->targetGroups = TargetGroup::orderBy('name')->get();
    }

    public function submit()
    {
        $this->validate();

        $this->service->save();
        $this->service->targetGroups()->sync(TargetGroup::whereIn('slug', $this->checkedTargetGroups)->get());
    }
}
