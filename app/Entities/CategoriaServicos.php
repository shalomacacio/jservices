<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CategoriaServicos.
 *
 * @package namespace App\Entities;
 */
class CategoriaServicos extends Model implements Transformable
{
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
