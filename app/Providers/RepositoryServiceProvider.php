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
        $this->app->bind(\App\Repositories\TecnicoRepository::class, \App\Repositories\TecnicoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StatusSolicitacaoRepository::class, \App\Repositories\StatusSolicitacaoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TecnologiaRepository::class, \App\Repositories\TecnologiaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CategoriaServicoRepository::class, \App\Repositories\CategoriaServicoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TipoPagamentoRepository::class, \App\Repositories\TipoPagamentoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TipoMidiaRepository::class, \App\Repositories\TipoMidiaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TipoUsuarioRepository::class, \App\Repositories\TipoUsuarioRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TipoAquisicaoRepository::class, \App\Repositories\TipoAquisicaoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ClienteRepository::class, \App\Repositories\ClienteRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TipoComissaoRepository::class, \App\Repositories\TipoComissaoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ComissaoRepository::class, \App\Repositories\ComissaoRepositoryEloquent::class);
        //:end-bindings:
    }
}
