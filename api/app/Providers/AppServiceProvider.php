<?php

namespace App\Providers;

use Carbon\Carbon;
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
        // Hand over all Exceptions to App Exceptions Handler
        app(\Dingo\Api\Exception\Handler::class)->register(function (\Exception $exception) {
            $request = \Illuminate\Http\Request::capture();
            return app('App\Exceptions\Handler')->render($request, $exception);
        });
    }
}
