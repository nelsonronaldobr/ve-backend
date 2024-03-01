<?php

namespace App\Models\v1\Relationships;


use App\Models\v1\Email;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait UserRelationships
{
    public function emails(): MorphMany
    {
        return $this->morphMany(Email::class, 'emailable', 'emailable_type', 'emailable_uuid');
    }
}
