<?php

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

use App\Http\Kernel as HttpKernel;
use Illuminate\Http\Request;

/** @var HttpKernel $kernel */
$kernel = $app->make(HttpKernel::class);

$response = $kernel->handle(
    $request = Request::capture()
);

$response->send();

$kernel->terminate($request, $response);

// use Illuminate\Foundation\Application;
// use Illuminate\Http\Request;

// define('LARAVEL_START', microtime(true));

// // Determine if the application is in maintenance mode...
// if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
//     require $maintenance;
// }

// // Register the Composer autoloader...
// require __DIR__.'/../vendor/autoload.php';

// $app = require_once __DIR__.'/../bootstrap/app.php';

// /** @var Kernel $kernel */
// $kernel = $app->make(Kernel::class);

// $response = $kernel->handle(
//     $request = Request::capture()
// );

// $response->send();

// $kernel->terminate($request, $response);
// // Bootstrap Laravel and handle the request...
// /** @var Application $app */
// $app = require_once __DIR__.'/../bootstrap/app.php';

// $app->handleRequest(Request::capture());
