<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use SoftDeletes;
    use HasUuids;

    protected $fillable = [
        'email',
        'emailable_uuid',
        'emailable_type',
        'is_main',
    ];

    protected $casts = [
        'is_main' => 'boolean'
    ];

    public static string $morphClass = 'App\\Email';
}
