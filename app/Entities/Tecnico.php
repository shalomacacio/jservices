<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tecnico.
 *
 * @package namespace App\Entities;
 */
class Tecnico extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome','sobrenome', 'email', 'telefone'];


    //Relacionamentos
    public function solicitacoes()
    {
        return $this->belongsToMany('App\Entities\Solicitacao')
        ->withTimestamps();
    }

}
