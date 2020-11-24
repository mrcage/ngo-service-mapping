<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TargetGroup extends Model
{
    use Sluggable;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

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

    protected static function booted()
    {
        static::deleting(function ($targetGroup) {
            $targetGroup->services()->detach();
        });
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function organizations(): Collection
    {
        return $this->services->map(fn ($s) => $s->organization)->unique('id');
    }

    public function locations(): Collection
    {
        return $this->services->map(fn ($s) => $s->location)->unique('id');
    }

    public function sectors(): Collection
    {
        return $this->services->map(fn ($s) => $s->sector)->unique('id');
    }

    public function organizationTypes(): Collection
    {
        return $this->services->map(fn ($s) => $s->organization)
            ->map(fn ($o) => $o->type)
            ->unique('id');
    }
}
