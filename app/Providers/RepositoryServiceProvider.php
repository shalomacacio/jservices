<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ServicoRepository::class, \App\Repositories\ServicoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SolicitacaoRepository::class, \App\Repositories\SolicitacaoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SolicitacaoStatusRepository::class, \App\Repositories\SolicitacaoStatusRepositoryEloquent::class);
        //:end-bindings:
    }
}
