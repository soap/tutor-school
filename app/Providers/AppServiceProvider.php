<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Sets third party service providers that are only needed on local environments
         */
        if ($this->app->environment() == 'local') {
            /**
             * Loader for registering facades
             */
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();

            /**
             * Load third party local providers and facades
             */
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $loader->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);

            $this->app->register(\Laracasts\Generators\GeneratorsServiceProvider::class);
        }
    }
}
