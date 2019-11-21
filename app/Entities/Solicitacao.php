<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Solicitacao.
 *
 * @package namespace App\Entities;
 */
class Solicitacao extends Model implements Transformable
{
    use TransformableTrait;

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
        'dt_conclusao',
        'servico_vlr',
        'forma_pagamento',
        'tipo_aquisicao',
        'comissao_atendimento',
        'comissao_equipe',
        'comissao_supervisor',
        'flg_autorizado',
        'obs'
    ];

    //Mutator
    public function setComissaoAtendimentoAttribute(){
        $comissao  =  $this->calcularComissao($this->servico->tip_comiss_atend, $this->servico->servico_vlr, $this->servico->comissao_atendimento);
        $this->attributes['comissao_atendimento'] = $comissao;
    }

    public function setComissaoEquipeAttribute(){
        $comissao  =  $this->calcularComissao($this->servico->tip_comiss_eq, $this->servico->servico_vlr, $this->servico->comissao_equipe);
        $this->attributes['comissao_equipe'] = $comissao;
    }

    public function setComissaoSupervisorAttribute(){
        $comissao  =  $this->calcularComissao($this->servico->tip_comiss_sup, $this->servico->servico_vlr, $this->servico->comissao_supervisor);
        $this->attributes['comissao_supervisor'] = $comissao;
    }

    public function setServicoVlrAttribute(){
      $this->attributes['servico_vlr'] = $this->servico->servico_vlr;
  }

    //Relacionamentos
    public function servico()
    {
        return $this->belongsTo('App\Entities\Servico');
    }

    public function tecnicos()
    {
        return $this->belongsToMany('App\Entities\Tecnico')
        ->withTimestamps();
    }

    public function statusSolicitacao()
    {
        return $this->belongsTo('App\Entities\StatusSolicitacao');
    }

    public function tecnologias()
    {
        return $this->belongsTo('App\Entities\Tecnologia');
    }

    //Regras de Negócio
    public function calcularComissao( $tipoComissao,$valor, $comissao )
    {
        if($tipoComissao == 'percentual')
            return $valor * ($comissao/100);
        else{
            return $comissao;
        }
    }
}
