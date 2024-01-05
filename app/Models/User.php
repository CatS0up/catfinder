<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
        'password' => 'hashed',
    ];

    /**
     * @return Attribute<string, string>
     */
    public function password(): Attribute
    {
        return new Attribute(set: fn (string $value) => Hash::make($value));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Cat>
     */
    public function adoptedCats(): HasMany
    {
        return $this->hasMany(Cat::class, 'adopter_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Cat>
     */
    public function addedCats(): HasMany
    {
        return $this->hasMany(Cat::class, 'adding_user_id');
    }
}
