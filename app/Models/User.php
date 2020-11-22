<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    public function scopeFilter(Builder $query, $value)
    {
        return $query->where('name', 'like', '%' . trim($value) . '%')
            ->orWhere('email', trim($value));
    }

    public function getIsEmailVerifiedAttribute(): bool
    {
        return isset($this->email_verified_at);
    }

    public function setIsEmailVerifiedAttribute($value)
    {
        if ($value && !isset($this->email_verified_at)) {
            $this->email_verified_at = now();
        } else if (!$value) {
            $this->email_verified_at = null;
        }
    }
}
