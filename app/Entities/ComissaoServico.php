<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ComissaoServico.
 *
 * @package namespace App\Entities;
 */
class ComissaoServico extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
    [
      'descricao',
      'servico_id',
      'vlr',
      'tipo_comissao_id',
    ];

    public function tipoComissao(){
      return $this->belongsTo('App\Entities\TipoComissao');
    }

}
