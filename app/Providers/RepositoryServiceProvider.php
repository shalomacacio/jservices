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
        $this->app->bind(\App\Repositories\ComissaoServicoRepository::class, \App\Repositories\ComissaoServicoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EscalaRepository::class, \App\Repositories\EscalaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ReportRepository::class, \App\Repositories\ReportRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PlanoRepository::class, \App\Repositories\PlanoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MkPessoaRepository::class, \App\Repositories\MkPessoaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MkBairroRepository::class, \App\Repositories\MkBairroRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrigemVendaRepository::class, \App\Repositories\OrigemVendaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MkAtendimentoRepository::class, \App\Repositories\MkAtendimentoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MkAteProcessoRepository::class, \App\Repositories\MkAteProcessoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MotivoCancelamentoRepository::class, \App\Repositories\MotivoCancelamentoRepositoryEloquent::class);
        //:end-bindings:
    }
}
