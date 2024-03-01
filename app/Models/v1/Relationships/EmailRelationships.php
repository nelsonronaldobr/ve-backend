<?php

namespace App\Models\v1\Relationships;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait EmailRelationships
{
    public function emailable(): MorphTo
    {
        return $this->morphTo('emailable', 'emailable_type', 'emailable_uuid');
    }
}
