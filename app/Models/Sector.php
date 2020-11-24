<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Collection;

class Sector extends Model
{
    use Sluggable;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    protected static function booted()
    {
        static::deleting(function ($sector) {
            $sector->services->each(function ($service) { $service->sector()->dissociate();});
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

    public function organizations(): Collection
    {
        return $this->services->map(fn ($s) => $s->organization)->unique('id');
    }

    public function locations(): Collection
    {
        return $this->services->map(fn ($s) => $s->location)->unique('id');
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
}
