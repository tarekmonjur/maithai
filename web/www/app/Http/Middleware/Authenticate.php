<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if ($request->routeIs(['api.*']) || $request->is(['api.*'])) {
            // do something for api call
        }

        if (! $request->expectsJson()) {
            return route(config('app.backend_home').'.login');
        }
    }
}
