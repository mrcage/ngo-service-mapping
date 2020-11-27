<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Dyrynda\Database\Support\NullableFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Location extends Model
{
    use HasFactory;
    use Sluggable;
    use NullableFields;

    protected $fillable = [
        'name',
        'description',
        'latitude',
        'longitude',
    ];

	protected $nullable = [
		'description',
        'latitude',
        'longitude',
    ];

    protected static function booted()
    {
        static::deleting(function ($location) {
            $location->services->each(function ($service) { $service->delete(); });
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'services')->distinct();
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'services')->distinct();
    }

    public function targetGroups(): Collection
    {
        return $this->services->flatMap(fn ($s) => $s->targetGroups)->unique('id');
    }

    public function organizationTypes(): Collection
    {
        return $this->services->map(fn ($s) => $s->organization)
            ->map(fn ($o) => $o->type)
            ->unique('id');
    }

    public function scopeFilter(Builder $query, $value)
    {
        return $query->where('name', 'like', '%' . trim($value) . '%');
    }

    public function getCoordinatesAttribute()
    {
        if (filled($this->latitude) && filled($this->longitude)) {
            return $this->latitude . ',' . $this->longitude;
        }
        return null;
    }

    public function setCoordinatesAttribute($coordinates)
    {
        if (filled($coordinates)) {
            [$this->latitude, $this->longitude] = self::parseCoordinates($coordinates);
        } else {
            $this->latitude = null;
            $this->longitude = null;
        }
    }

    public static function parseCoordinates($coordinates)
    {
        $arr = preg_split('/\s*,\s*/', $coordinates);
        return [$arr[0], $arr[1]];
    }
}
