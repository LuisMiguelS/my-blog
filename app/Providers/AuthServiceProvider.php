<?php

namespace App\Providers;

use App\{User};
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Tag' => 'App\Policies\TagPolicy',
        'App\Post' => 'App\Policies\PostPolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\Category' => 'App\Policies\CategoryPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (User $user) {
           if ($user->isAdmin())  { return true; }
        });

        Gate::define('only-admin', function ($user) {
            return $user->isAdmin();
        });
    }
}
