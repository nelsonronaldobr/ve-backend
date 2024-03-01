<?php

namespace App\Services\v1\Auth;

use App\Models\v1\User;
use App\Services\v1\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AuthService extends Service
{
    public function getModel(): User|Model
    {
        return $this->model;
    }

    public function createUserAndStoreEmail(Request $request): void
    {
        $user = User::query()->create($request->except('email'));
        $this->setModel($user);
        $this->createEmail($request->only('email'));
    }

    public function createEmail(array $attributes): void
    {
        $this->getModel()->emails()->create($attributes);
    }
}
