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
    protected $fillable = [
      'descricao',
      'valor',
      'tipo_comissao_id'
    ];

    public function servicos()
    {
        return $this->belongsToMany('App\Entities\Servico')
        ->withTimestamps();
    }

}
