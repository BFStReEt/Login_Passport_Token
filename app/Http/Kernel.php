<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        //'permission' => \App\Http\Middleware\CheckPermission::class,
    ];

    protected $middleware = [
        \Illuminate\Http\Middleware\HandleCors::class,
    ];
}
