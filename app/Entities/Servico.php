<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Servico.
 *
 * @package namespace App\Entities;
 */
class Servico extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
      [
        'categoria_servico_id',
        'descricao' ,
        'servico_vlr',
        'pontuacao',
      ];

    public function solicitacao()
    {
        return $this->belongsTo('App\Entities\Solicitacao');
    }

    public function categoriaServico()
    {
        return $this->belongsTo('App\Entities\CategoriaServico');
    }

    public function comissaos()
    {
        return $this->belongsToMany('App\Entities\Comissao')
        ->withTimestamps();
    }



}
