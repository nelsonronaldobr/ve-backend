<?php

namespace App\Models\v1;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasUuids;
    use SoftDeletes;
    use Sluggable;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'sex',
        'birth_date',
        'token',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'birth_date' => 'datetime',
        'token' => 'hashed',
        'password' => 'hashed',
    ];

    public static string $morphClass = 'App\\User';

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['first_name', 'last_name']
            ]
        ];
    }
}
