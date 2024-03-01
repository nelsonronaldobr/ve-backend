<?php

namespace App\Models\v1;

use App\Models\v1\BaseModels\UserBase;

class User extends UserBase
{
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'slug',
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
}
