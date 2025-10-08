<?php

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
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'waiter' => \App\Http\Middleware\WaiterMiddleware::class,
            'kasir' => \App\Http\Middleware\CashierMiddleware::class,
            'owner' => \App\Http\Middleware\OwnerMiddleware::class,
            'can.manage.menus' => \App\Http\Middleware\CanManageMenus::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
