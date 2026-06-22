<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Deteksi Vercel dan siapkan folder /tmp SEBELUM Laravel boot
if (isset($_ENV['VERCEL']) || getenv('VERCEL')) {
    $dirs = [
        '/tmp/app',
        '/tmp/framework/views',
        '/tmp/framework/cache/data',
        '/tmp/framework/sessions',
        '/tmp/framework/testing',
        '/tmp/logs',
    ];
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }
}

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// Set storage path SETELAH create() tapi sebelum request dihandle
// NOTE: ini terlambat untuk ViewServiceProvider di Laravel 12,
// jadi kita pakai pendekatan langsung lewat $_ENV di atas
if (isset($_ENV['VERCEL']) || getenv('VERCEL')) {
    $app->useStoragePath('/tmp');
}

return $app;
