<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Check maintenance mode
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Autoload
require __DIR__.'/../vendor/autoload.php';

// Bootstrap app
$app = require_once __DIR__.'/../bootstrap/app.php';

// Get HTTP Kernel
$kernel = $app->make(Kernel::class);

// Handle request
$response = tap($kernel->handle(
    $request = Request::capture()
))->send();

// Terminate
$kernel->terminate($request, $response);