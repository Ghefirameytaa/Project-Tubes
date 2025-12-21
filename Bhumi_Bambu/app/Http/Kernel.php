<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // global middleware
    ];

    protected $middlewareGroups = [
        'web' => [
            // middleware web
        ],
        'api' => [
            // middleware api
        ],
    ];

    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\IsAdmin::class,
        'auth'  => \App\Http\Middleware\Authenticate::class,
    ];
}
