<?php

namespace App\Providers;

use Laravel\Passport\Passport as Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Gate::define('isAdmin', function ($user) {
            return $user->hasRole('super-admin');
        });
        Gate::define('isRT', function ($user) {
            return $user->hasRole('Kepala RT');
        });
        Gate::define('isBendahara', function ($user) {
            return $user->hasRole('Bendahara');
        });
        Gate::define('isWarga', function ($user) {
            return $user->hasRole('Warga');
        });


        //
    }
}
