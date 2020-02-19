<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Solicitacao.
 *
 * @package namespace App\Entities;
 */
class Solicitacao extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codpessoa',
        'cliente_id',
        'nome_razaosocial',
        'user_id',
        'user_atendimento_id',
        'categoria_servico_id',
        'servico_id',
        'tecnologia_id',
        'status_solicitacao_id',
        'dt_agendamento',
        'dt_conclusao',
        'servico_vlr',
        'vlr_servico',
        'plano_id',
        'vlr_plano',
        'vlr_plano_ant',
        'vlr_plano_dif',
        'plano_ant_id',
        'tipo_pagamento_id',
        'tipo_midia_id',
        'tipo_aquisicao_id',
        'turno_agendamento',
        'origem_venda_id',
        'motivo_cancelamento_id',
        'obs'
    ];

    public function setServicoVlrAttribute(){
      $this->attributes['servico_vlr'] = $this->servico->servico_vlr;
  }

    //Relacionamentos
    public function servico()
    {
        return $this->belongsTo('App\Entities\Servico');
    }

    public function users()
    {
        return $this->belongsToMany('App\Entities\User')
        ->withTimestamps();
    }

    public function user()
    {
      return $this->belongsTo('App\Entities\User', 'user_atendimento_id');
    }

    public function statusSolicitacao()
    {
        return $this->belongsTo('App\Entities\StatusSolicitacao');
    }

    public function tipoPagamento()
    {
        return $this->belongsTo('App\Entities\TipoPagamento');
    }

    public function tipoMidia()
    {
        return $this->belongsTo('App\Entities\TipoMidia');
    }

    public function tipoAquisicao()
    {
        return $this->belongsTo('App\Entities\TipoAquisicao');
    }
    public function tecnologia()
    {
        return $this->belongsTo('App\Entities\Tecnologia');
    }

    public function categoriaServico()
    {
        return $this->belongsTo('App\Entities\CategoriaServico');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Entities\Cliente');
    }

    public function plano()
    {
        return $this->belongsTo('App\Entities\Plano');
    }

    public function planoAnt()
    {
        return $this->belongsTo('App\Entities\Plano', 'plano_ant_id');
    }

    public function origem()
    {
        return $this->belongsTo('App\Entities\OrigemVenda', 'origem_venda_id');
    }

    public function mkPessoa()
    {
        return $this->belongsTo('App\Entities\MkPessoa', 'codpessoa');
    }

}
