<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Illuminate\Support\Str;

class LocationMap extends PageComponent
{
    protected $view = 'livewire.location-map';

    protected $title = 'Map';

    public $map;

    public $message;

    public function mount()
    {
        if (blank(config('services.google.maps.api-key'))) {
            $this->message = 'No Google maps API key defined.';
            return;
        }

        $locations = Location::query()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        $googlemaps = app('map');
        $googlemaps->initialize([
            'zoom' => 'auto',
        ]);
        foreach ($locations as $location) {
            $content = '<strong>' . preg_replace('/\s+/', ' ', $location->name) . '</strong><br>';
            if (isset($location->description)) {
                $content .= '<p>' . Str::words(preg_replace('/\s+/', ' ', $location->description), 10) . '</p>';
            }
            $content .= '<p><strong>Sectors:</strong> ' . $location->sectors()->orderBy('name')->get()->pluck('name')->implode(', ') . '</p>';
            $content .= '<p><strong>Target groups:</strong> ' . $location->targetGroups()->sortBy('name')->pluck('name')->implode(', ') . '</p>';

            $content .= '<a href="' . route('locations.show', $location) . '" target="_blank">Show more</a>';
            $googlemaps->add_marker([
                'position' => $location->coordinates,
                'infowindow_content' => $content,
                // 'icon' => 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000',
            ]);
        }
        $this->map = $googlemaps->create_map();
    }
}
