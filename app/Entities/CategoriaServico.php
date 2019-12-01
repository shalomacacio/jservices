<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;



/**
 * Class CategoriaServico.
 *
 * @package namespace App\Entities;
 */
class CategoriaServico extends Model implements Transformable
{
    use SoftDeletes;
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['descricao'];

    public function servicos()
    {
        return $this->belongsTo('App\Entities\Servico');
    }

}
