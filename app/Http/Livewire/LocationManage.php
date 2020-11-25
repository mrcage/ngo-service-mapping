<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Illuminate\Validation\Rule;

abstract class LocationManage extends PageComponent
{
    public Location $location;

    public string $cancelUrl;

    protected $rules = [
        'location.name' => [
            'filled',
            'string',
            'min:3',
            'max:255',
        ],
        'location.description' => [
            'nullable',
            'min:3',
        ],
        'location.latitude' => [
            'nullable',
            'numeric',
            'regex:/^[-]?((([0-8]?[0-9])(\.(\d{1,14}))?)|(90(\.0+)?))$/',
            'required_with:location.longitude',
        ],
        'location.longitude' => [
            'nullable',
            'numeric',
            'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))(\.(\d{1,14}))?)|180(\.0+)?)$/',
            'required_with:location.latitude',
        ],
    ];

    public function mount()
    {
        // ...
    }

    public function submit()
    {
        $this->validate();

        if ($this->location->exists) {
            $this->validate([
                'location.name' => Rule::unique(Location::class, 'name')
                    ->ignore($this->location->id),
            ]);
        } else {
            $this->validate([
                'location.name' => Rule::unique(Location::class, 'name'),
            ]);
        }

        $this->location->save();
    }

    public function detectLocation()
    {
        $geoIp = geoip()->getLocation();
        if (is_numeric($geoIp['lat']) && is_numeric($geoIp['lon'])) {
            $this->location->latitude = $geoIp['lat'];
            $this->location->longitude = $geoIp['lon'];
        }
    }
}
