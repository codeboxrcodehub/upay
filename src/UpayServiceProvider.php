<?php

namespace Codeboxr\Upay;

use Codeboxr\Upay\Managers\Payment;
use Illuminate\Support\ServiceProvider;

class UpayServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . "/../config/upay.php" => config_path("upay.php")
        ]);
    }

    /**
     * Register application services
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . "/../config/upay.php", "upay");

        $this->app->bind("payment", function () {
            return new Payment();
        });
    }

}
