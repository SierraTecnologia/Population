<?php

namespace Population;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class PopulationProvider extends ServiceProvider
{
    public static $providers = [
        \Informate\InformateProvider::class,
    ];

    /**
     * Alias the services in the boot.
     */
    public function boot()
    {
        // $this->publishes([
        //     __DIR__.'/Publishes/resources/tools' => base_path('resources/tools'),
        //     __DIR__.'/Publishes/app/Services' => app_path('Services'),
        //     __DIR__.'/Publishes/public/js' => base_path('public/js'),
        //     __DIR__.'/Publishes/public/css' => base_path('public/css'),
        //     __DIR__.'/Publishes/public/img' => base_path('public/img'),
        //     __DIR__.'/Publishes/config' => base_path('config'),
        //     __DIR__.'/Publishes/routes' => base_path('routes'),
        //     __DIR__.'/Publishes/app/Controllers' => app_path('Http/Controllers/Population'),
        // ]);

        // $this->publishes([
        //     __DIR__.'../resources/views' => base_path('resources/views/vendor/Population'),
        // ], 'SierraTecnologia Population');
    }

    /**
     * Register the services.
     */
    public function register()
    {
        $this->setProviders();

        // // View namespace
        // $this->loadViewsFrom(__DIR__.'/Views', 'Population');

        // if (is_dir(base_path('resources/Population'))) {
        //     $this->app->view->addNamespace('Population-frontend', base_path('resources/Population'));
        // } else {
        //     $this->app->view->addNamespace('Population-frontend', __DIR__.'/Publishes/resources/Population');
        // }

        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        // // Configs
        // $this->app->config->set('Population.modules.Population', include(__DIR__.'/config.php'));

        /*
        |--------------------------------------------------------------------------
        | Register the Commands
        |--------------------------------------------------------------------------
        */

        $this->commands([]);
    }

    private function setProviders()
    {
        (new Collection(self::$providers))->map(function ($provider) {
            $this->app->register($provider);
        });
    }

}
