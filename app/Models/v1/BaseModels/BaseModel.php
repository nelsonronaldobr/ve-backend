<?php

namespace App\Models\v1\BaseModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;

class BaseModel extends Model
{
    public $incrementing = false;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = Uuid::uuid4()->toString();
            }
        });
    }

    public function getMorphClass()
    {
        if (isset(static::$morphClass)) {
            return static::$morphClass;
        }
        return parent::getMorphClass();
    }

    public static function getActualClassNameForMorph($class)
    {
        if (isset(static::$morphClassMap) && !empty(static::$morphClassMap)) {
            return Arr::get(static::$morphClassMap ?: [], $class, $class);
        }
        return Arr::get(Relation::morphMap() ?: [], $class, $class);
    }
}
