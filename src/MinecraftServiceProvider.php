<?php

namespace Juggl\Minecraft;

use Illuminate\Support\ServiceProvider;

class MinecraftServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['minecraft'] = $this->app->share(function($app) {
            return new Minecraft;
        });
    }
}