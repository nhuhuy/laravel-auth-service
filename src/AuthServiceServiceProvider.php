<?php

namespace nhuhuy\AuthService;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AuthServiceServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'nhuhuy');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'nhuhuy');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        $this->app->bind(
            AuthServiceInterface::class,
            AuthService::class
        );

        Route::group(['prefix' => 'api/auth', 'namespace' => 'nhuhuy\\AuthService\\Controllers', 'middleware' => ['api']],
            function () {
                Route::post('/login', 'AuthController@store');
            }
        );
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/authservice.php', 'authservice');

        // Register the service the package provides.
        $this->app->singleton('authservice', function ($app) {
            return new AuthService;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['authservice'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/authservice.php' => config_path('authservice.php'),
        ], 'authservice.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/nhuhuy'),
        ], 'authservice.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/nhuhuy'),
        ], 'authservice.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/nhuhuy'),
        ], 'authservice.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
