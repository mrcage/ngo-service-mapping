<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class TargetGroup extends Model
{
    use Sluggable;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    protected static function booted()
    {
        static::deleting(function ($sector) {
            $sector->services()->detach();
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
        return $this->belongsToMany(Service::class);
    }
}
