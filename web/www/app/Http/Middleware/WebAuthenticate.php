<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class WebAuthenticate extends Middleware
{
    protected $auth_guards;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (empty($request->input('access_token'))) {
            $request->offsetSet('access_token', session('access_token'));
        }

        if (empty($request->input('api_token'))) {
            $request->offsetSet('api_token', session('api_token'));
        }

        $this->auth_guards = $guards;

        $this->authenticate($request, $guards);

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (is_array($this->auth_guards) && !empty($this->auth_guards)) {
                if ($this->auth_guards[0] === 'customer') {
                    return route('login');
                }
            }
            return route(config('app.backend_home').'.login');
        }
    }
}
