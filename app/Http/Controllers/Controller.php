<?php

namespace App\Http\Controllers;

use App\Traits\MessageTrait;
use Illuminate\Routing\Controllers\Middleware;

abstract class Controller
{
    use MessageTrait;

    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', null, ['index', 'show']),
        ];
    }
}
