<?php

namespace App\Models;

use Dyrynda\Database\Support\NullableFields;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use NullableFields;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'timezone',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    protected $attributes = [
        'is_admin' => false,
    ];

	protected $nullable = [
		'timezone',
	];

    public function scopeFilter(Builder $query, $value)
    {
        return $query->where('name', 'like', '%' . trim($value) . '%')
            ->orWhere('email', trim($value));
    }

    public function setEmailAsVerified(bool $verified)
    {
        if ($verified && !$this->hasVerifiedEmail()) {
            $this->email_verified_at = $this->freshTimestamp();
        } elseif (!$verified) {
            $this->email_verified_at = null;
        }
    }
}
