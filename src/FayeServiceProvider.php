<?php

namespace LinkThrow\Faye;

use Illuminate\Support\ServiceProvider;

class FayeServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            dirname(dirname(__FILE__)) . '/config/config.php' => config_path('faye.php')
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['faye'] = $this->app->share(function ($app) {
            $url = $this->app['config']['faye-url'];
            $adapter = new \Nc\FayeClient\Adapter\CurlAdapter();
            return new \Nc\FayeClient\Client($adapter, $url);
        });
    }
}
