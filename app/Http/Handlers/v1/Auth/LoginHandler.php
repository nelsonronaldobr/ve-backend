<?php

namespace App\Http\Handlers\v1\Auth;

use Illuminate\Http\JsonResponse;

class LoginHandler
{
    public function __invoke(): JsonResponse
    {
        return response()->json(['login']);
    }
}
