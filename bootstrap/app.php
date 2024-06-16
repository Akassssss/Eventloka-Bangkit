<?php

use App\Http\Middleware\initiator;
use App\Http\Middleware\isLogin;
use App\Http\Middleware\notLogin;
use App\Http\Middleware\organizer;
use App\Http\Middleware\userAkses;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isLogin'=> isLogin::class,
            'notLogin'=> notLogin::class,
            'initiator'=> initiator::class,
            'organizer'=> organizer::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
