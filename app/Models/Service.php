<?php

namespace App\Models;

use Dyrynda\Database\Support\NullableFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    use HasFactory;
    use NullableFields;

    protected $fillable = [
        'name',
        'description',
    ];

	protected $nullable = [
		'description',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
