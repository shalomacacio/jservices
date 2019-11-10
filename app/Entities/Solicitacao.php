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
        'tipo_aquisicao',
        'comissao_atendimento',
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

    //Regras de Negócio
    public function calcularComissao( $tipoComissao,$valor, $comissao ){
        if($tipoComissao == 'percentual')
            return $valor * ($comissao/100);
        else{
            return $comissao;
        }
    }
}
