<?php

use App\Http\Handlers\v1\Auth\LoginHandler;
use App\Http\Handlers\v1\Auth\RegisterHandler;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(
    function () {
        Route::post('/login', LoginHandler::class);
        Route::post('/register', RegisterHandler::class);
    }
);
