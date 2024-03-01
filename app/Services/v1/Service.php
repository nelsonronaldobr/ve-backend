<?php

namespace App\Services\v1;

use Illuminate\Database\Eloquent\Model;

abstract class Service
{
    protected Model $model;

    public static string $modelClass;

    abstract public function getModel(): Model;

    public function setModel(Model $model): self
    {
        $this->model = $model;
        return $this;
    }

    public static function getModelClass(): string
    {
        if (empty(self::$modelClass)) {
            throw new \UnexpectedValueException('The class model fot this service is not defined.');
        }
        return self::$modelClass;
    }
}
