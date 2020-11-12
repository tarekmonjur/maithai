<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        if (Request::has('access_token') || Request::hasHeader('access-token')) {
            if (Request::hasHeader('access-token')) {
                Request::offsetSet('access_token', Request::header('access-token'));
            }
            Request::offsetSet('guard', 'customer');
        }

        if (Request::has('api_token') || Request::hasHeader('api-token')) {
            if (Request::hasHeader('api-token')) {
                Request::offsetSet('api_token', Request::header('api-token'));
            }
            Request::offsetSet('guard', 'user');
        }

        $this->registerPolicies();

        //
    }
}
