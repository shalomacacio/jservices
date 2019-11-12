<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Servico.
 *
 * @package namespace App\Entities;
 */
class Servico extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['descricao' ,'comissao_atendimento', 'tip_comiss_atend', 'comissao_equipe','tip_comiss_eq', 'comissao_supervisor', 'tip_comiss_sup'];

    public function solicitacao()
    {
        return $this->belongsTo('App\Entities\Solicitacao');
    }

}
