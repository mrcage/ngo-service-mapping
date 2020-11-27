<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Illuminate\Support\Str;

class LocationMap extends PageComponent
{
    protected $view = 'livewire.location-map';

    protected $title = 'Map';

    protected $wideLayout = true;

    protected $noPadding = true;

    public $message;

    public array $map = [];

    public function mount()
    {
        $locations = Location::query()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        $markers = [];
        foreach ($locations as $location) {
            $content = '<strong>' . preg_replace('/\s+/', ' ', $location->name) . '</strong><br>';
            if (isset($location->description)) {
                $content .= '<p>' . Str::words(preg_replace('/\s+/', ' ', $location->description), 10) . '</p>';
            }
            if ($location->sectors()->exists()) {
                $str = $location->sectors()->orderBy('name')->get()->pluck('name')->implode(', ');
                $content .= '<p><strong>Sectors:</strong> ' . Str::words($str, 10) . '</p>';
            }
            if ($location->targetGroups()->isNotEmpty()) {
                $str = $location->targetGroups()->sortBy('name')->pluck('name')->implode(', ');
                $content .= '<p><strong>Target groups:</strong> ' . Str::words($str, 10) . '</p>';
            }
            $content .= '<a href="' . route('locations.show', $location) . '" target="_blank">More information</a>';

            $markers[] = [
                'title' => $location->name,
                'lat' => $location->latitude,
                'lng' => $location->longitude,
                'popup' => $content,
            ];
        }

        $latMax = $locations->pluck('latitude')->max();
        $latMin = $locations->pluck('latitude')->min();
        $lngMax = $locations->pluck('longitude')->max();
        $lngMin = $locations->pluck('longitude')->min();
        $lat = $latMin + (($latMax - $latMin)/2);
        $lng = $lngMin + (($lngMax - $lngMin)/2);

        $this->map = [
            'lat' => $lat,
            'lng' => $lng,
            'zoom' => 1,
            'markers' => $markers,
        ];
    }
}
