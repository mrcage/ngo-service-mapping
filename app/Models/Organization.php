<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Dyrynda\Database\Support\NullableFields;
use Illuminate\Database\Eloquent\Builder;

class Organization extends Model
{
    use HasFactory;
    use Sluggable;
    use NullableFields;

    protected $fillable = [
        'name',
        'description',
        'email',
        'website',
    ];

	protected $nullable = [
		'description',
		'email',
		'website',
	];

    protected static function booted()
    {
        static::deleting(function ($organization) {
            $organization->sectors()->detach();
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

    public function scopeFilter(Builder $query, $value)
    {
        return $query->where('name', 'like', '%' . trim($value) . '%')
            ->orWhere('email', trim($value));
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class);
    }

    public function type()
    {
        return $this->belongsTo(OrganizationType::class, 'type_id');
    }
}
