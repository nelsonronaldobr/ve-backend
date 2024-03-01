<?php

namespace App\Models\v1;

use App\Models\v1\BaseModels\BaseModel;
use App\Models\v1\Relationships\EmailRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends BaseModel
{
    use SoftDeletes;
    use EmailRelationships;

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
