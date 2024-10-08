<?php

namespace Belokdwi\Bpjs;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class BpjsServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/bpjs.php';
        $this->publishes([$configPath => config_path('bpjs.php')], 'config');
    }
}
