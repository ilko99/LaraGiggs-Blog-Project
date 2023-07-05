<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Listing' => 'App\Policies\ListingPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('listing.update', 'App\Policies\ListingPolicy@update');
        Gate::define('listing.delete', 'App\Policies\ListingPolicy@delete');

        Gate::before(function($user){
            if($user->is_admin){
                return true;
            }
        });

    }
}
