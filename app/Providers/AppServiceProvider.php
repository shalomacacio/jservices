<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //correção do "is not instantiable while building "
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Carbon::setLocale(env('LOCALE', 'pt-BR'));
    }
}
