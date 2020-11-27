<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Illuminate\Support\Str;

class LocationMap extends PageComponent
{
    private const ZOOM_LEVEL = 14;

    protected $view = 'livewire.location-map';

    protected $title = 'Map';

    protected $wideLayout = true;

    protected $noPadding = true;

    public $message;

    public array $map = [];

    public $coordinates;

    protected $queryString = ['coordinates'];

    public function mount()
    {
        $locations = Location::query()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        $markers = collect();
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
            $content .= '<a href="' . route('locations.show', $location) . '">More information</a>';

            $markers->push([
                'title' => $location->name,
                'lat' => $location->latitude,
                'lng' => $location->longitude,
                'popup' => $content,
            ]);
        }

        if (isset($this->coordinates)) {
            [$lat, $lng] = Location::parseCoordinates($this->coordinates);
            $zoom = self::ZOOM_LEVEL;
            if ($markers->where('lat', $lat)->where('lng', $lng)->isEmpty()) {
                $markers->push([
                    'title' => $this->coordinates,
                    'lat' => $lat,
                    'lng' => $lng,
                ]);
            }
        } else {
            $latMax = $locations->pluck('latitude')->max();
            $latMin = $locations->pluck('latitude')->min();
            $lngMax = $locations->pluck('longitude')->max();
            $lngMin = $locations->pluck('longitude')->min();
            $lat = $latMin + (($latMax - $latMin)/2);
            $lng = $lngMin + (($lngMax - $lngMin)/2);
            $zoom = 1;
        }

        $this->map = [
            'lat' => $lat,
            'lng' => $lng,
            'zoom' => $zoom,
            'markers' => $markers->toArray(),
        ];
    }
}
