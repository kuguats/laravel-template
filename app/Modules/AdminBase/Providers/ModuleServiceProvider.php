<?php

namespace App\Modules\AdminBase\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     * @throws \Caffeinated\Modules\Exceptions\ModuleNotFoundException
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('AdminBase', 'Resources/Lang', 'app'), 'AdminBase');
        $this->loadViewsFrom(module_path('AdminBase', 'Resources/Views', 'app'), 'AdminBase');
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
