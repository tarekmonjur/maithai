<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (empty($request->input('access_token'))) {
            $request->offsetSet('access_token', session('access_token'));
        }

        if (empty($request->input('api_token'))) {
            $request->offsetSet('api_token', session('api_token'));
        }

        if (Auth::guard($guard)->check()) {
            if ($guard === 'customer') {
                return redirect(RouteServiceProvider::FRONTEND_HOME);
            }
            return redirect(RouteServiceProvider::BACKEND_HOME);
        }

        return $next($request);
    }
}
