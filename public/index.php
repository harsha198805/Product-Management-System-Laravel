<?php

define('LARAVEL_START', microtime(true));

// Check if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap the application...
$app = require_once __DIR__.'/../bootstrap/app.php';

// Create the kernel to handle the HTTP request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Capture the request and handle it through the kernel
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Send the response back to the client
$response->send();

// Terminate the kernel, finishing the request lifecycle
$kernel->terminate($request, $response);
