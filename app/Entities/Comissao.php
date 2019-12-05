<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comissao.
 *
 * @package namespace App\Entities;
 */
class Comissao extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $incrementing = false;

    protected $fillable = [
      'dt_referencia',
      'funcionario_id',
      'solicitacao_id',
      'servico_id',
      'servico_vlr',
      'servico_comissao',
      'servico_tipo_comissao_id',
      'comissao_vlr'
    ];

    public function comissionar($servicoVlr, $servicoComissao, $tipoComissao){
      $comissao = 0;
      if($tipoComissao == 1){
        $comissao = $servicoComissao;
      } elseif ($tipoComissao == 2){
        $comissao = ($servicoComissao/100) * $servicoVlr;
      }
      return $comissao;
    }

    public function solicitacao()
    {
        return $this->belongsTo('App\Entities\Solicitacao');
    }

    public function servico()
    {
        return $this->belongsTo('App\Entities\Servico');
    }
}
