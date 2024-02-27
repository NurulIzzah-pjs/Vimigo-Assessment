<?php

namespace App\Providers;
use Laravel\Passport\Http\Middleware\CreateFreshApiToken;
use Illuminate\Support\Facades\Route; 
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        // $this->registerPolicies();
        // if (! $this->app->routesAreCached()) {
        //     // Passport::routes(function ($router) {
        //     //     $router->forAccessTokens();
        //     // });
      
        // }
        // Passport::tokensCan([
        //     'your-scope-name' => 'Scope description',
        // ]);
    }            
}
