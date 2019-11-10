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
        'servico_vlr',
        'forma_pagamento',
        'base_comissao',
        'tipo_aquisicao',
        'tecnico_id',
        'comissao_atendimento',
        'comissao_tecnico',
        'obs'
    ];

    //Mutator
    public function setComissaoAtendimentoAttribute(){
        $comissao  =  $this->calcularComissao($this->servico->tip_comiss_atend, $this->servico_vlr, $this->servico->comissao_atendimento);
        $this->attributes['comissao_atendimento'] = $comissao;
    }

    public function setComissaoTecnicoAttribute(){
        $comissao  =  $this->calcularComissao($this->servico->tip_comiss_tec, $this->servico_vlr, $this->servico->comissao_tecnico);
        $this->attributes['comissao_tecnico'] = $comissao;
    }

    //Relacionamentos
    public function servico(){
        return $this->belongsTo('App\Entities\Servico');
    }

    public function tecnico(){
        return $this->belongsTo('App\Entities\User', 'tecnico_id', 'id');
    }

    //Regras de Negócio
    public function calcularComissao( $tipoComissao,$valor, $comissao ){
        if($tipoComissao == 'percentual')
            return $valor * ($comissao/100);
        else{
            return $comissao;
        }
    }
}
