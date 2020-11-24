<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Dyrynda\Database\Support\NullableFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Organization extends Model
{
    use HasFactory;
    use Sluggable;
    use NullableFields;

    protected $fillable = [
        'name',
        'abbreviation',
        'description',
        'email',
        'phone',
        'website',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'linkedin',
    ];

	protected $nullable = [
        'abbreviation',
		'description',
		'email',
        'phone',
        'website',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'linkedin',
	];

    protected static function booted()
    {
        static::deleting(function ($organization) {
            $organization->services->each(function ($service) { $service->delete(); });
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

    public function type()
    {
        return $this->belongsTo(OrganizationType::class, 'type_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'services')->distinct();
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'services')->distinct();
    }

    public function targetGroups(): Collection
    {
        return $this->services->flatMap(fn ($s) => $s->targetGroups)->unique('id');
    }

    public function scopeFilter(Builder $query, $value)
    {
        $val = trim($value);
        return $query->where('name', 'like', '%' . $val . '%')
            ->orWhere('abbreviation', $val)
            ->orWhere('email', $val);
    }
}
