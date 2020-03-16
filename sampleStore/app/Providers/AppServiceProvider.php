<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require_once "../vendor/autoload.php";

            \PagSeguro\Library::initialize();
            \PagSeguro\Library::cmsVersion()->setName("SampleStore")->setRelease("1.0.0");
            \PagSeguro\Library::moduleVersion()->setName("SampleStore")->setRelease("1.0.0");
    }
}
