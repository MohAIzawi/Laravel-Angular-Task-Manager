<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user's first name (accessor for API responses)
     */
    public function getFirstNameAttribute()
    {
        return $this->attributes['first_name'];
    }

    /**
     * Get the user's last name (accessor for API responses)
     */
    public function getLastNameAttribute()
    {
        return $this->attributes['last_name'];
    }

    /**
     * Set the user's first name (mutator for database storage)
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = $value;
    }

    /**
     * Set the user's last name (mutator for database storage)
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = $value;
    }
}
