<?php

namespace App\Models\v1\BaseModels;

use App\Models\v1\Relationships\UserRelationships;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserBase extends Authenticatable implements JWTSubject
{
    use SoftDeletes;
    use Sluggable;
    use UserRelationships;

    protected $keyType = 'string';

    protected $primaryKey = 'uuid';

    public $incrementing = false;

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
                'source' => ['first_name', 'last_name'],
            ],
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = Uuid::uuid4()->toString();
            }
        });
    }

    public function getMorphClass(): string
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
