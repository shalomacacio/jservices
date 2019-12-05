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
        'cod_cliente',
        'cliente',
        'user_id',
        'servico_id',
        'tecnologia_id',
        'status_solicitacao_id',
        'dt_agendamento',
        'dt_conclusao',
        'servico_vlr',
        'tipo_pagamento_id',
        'tipo_midia_id',
        'tipo_aquisicao_id',
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

    public function statusSolicitacao()
    {
        return $this->belongsTo('App\Entities\StatusSolicitacao');
    }

    public function tiposPagamento()
    {
        return $this->belongsTo('App\Entities\TipoPagamento');
    }

    public function tecnologias()
    {
        return $this->belongsTo('App\Entities\Tecnologia');
    }

    public function comissaos()
    {
        return $this->hasMany('App\Entities\Comissao');
    }

}
