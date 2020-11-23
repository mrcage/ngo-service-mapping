<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Dyrynda\Database\Support\NullableFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    use Sluggable;
    use NullableFields;

    protected $fillable = [
        'name',
        'description',
        'coordinates',
    ];

	protected $nullable = [
		'description',
		'coordinates',
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

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'services')->distinct();
    }

    public function scopeFilter(Builder $query, $value)
    {
        return $query->where('name', 'like', '%' . trim($value) . '%');
    }
}
