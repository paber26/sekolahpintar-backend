<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function () {
            // Central API Routes (esekolahpintar.id, admin.esekolahpintar.id)
            $centralDomains = config('tenancy.central_domains', []);
            foreach ($centralDomains as $domain) {
                Route::middleware('api')
                    ->domain($domain)
                    ->prefix('api')
                    ->group(base_path('routes/api-central.php'));
            }

            // Tenant API Routes (*.esekolahpintar.id)
            Route::middleware([
                'api',
                \Stancl\Tenancy\Middleware\InitializeTenancyByDomain::class,
                \Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains::class
            ])->prefix('api')->group(base_path('routes/api-tenant.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Setup Sanctum / Stateful API
        $middleware->statefulApi();
        
        // Custom Role Middleware for Spatie
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
