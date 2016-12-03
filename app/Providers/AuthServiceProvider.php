<?php

namespace NotiConnect\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'NotiConnect\Model' => 'NotiConnect\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Enable laravel/passport authentication.
        Passport::routes();
        // Remove revoked auth tokens from the database.
        Passport::pruneRevokedTokens();
    }
}
