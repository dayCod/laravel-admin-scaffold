<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {

            Route::middleware('web')
                ->group(__DIR__.'/../routes/web/landing-page.php');

            Route::middleware(['web', 'guest'])
                ->prefix('auth')
                ->as('auth.')
                ->group(__DIR__.'/../routes/web/auth.php');

            Route::middleware(['web', 'auth'])
                ->prefix('admin')
                ->as('admin.')
                ->group(__DIR__.'/../routes/web/admin.php');

        }
    )
    ->withMiddleware(function (Middleware $middleware) {

        // Using Closure Guest Redirect to
        $middleware->redirectGuestsTo(fn (Request $request) => route('auth.login.view'));

        // Using Closure Authenticated Users Redirect to
        $middleware->redirectUsersTo(fn (Request $request) => route('admin.dashboard'));

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
