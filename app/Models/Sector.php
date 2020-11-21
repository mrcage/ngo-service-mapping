<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

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
            $sector->organizations()->detach();
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

    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }
}
