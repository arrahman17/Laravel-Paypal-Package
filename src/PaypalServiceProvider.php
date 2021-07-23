<?php


namespace Netmarket\Paypal;


use Illuminate\Support\ServiceProvider;

class PaypalServiceProvider extends ServiceProvider
{

    // will bootstrap the package

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__. '/views', 'paypal');
        $this->mergeConfigFrom(__DIR__. '/config/paypal.php', 'paypal');

        $this->publishes([
            __DIR__.'/config/paypal.php' => config_path('paypal.php'),
        ]);

    }

    public function register()
    {

    }
}
