<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class OrganizationType extends Model
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

    public function organizations()
    {
        return $this->hasMany(Organization::class, 'type_id');
    }
}
