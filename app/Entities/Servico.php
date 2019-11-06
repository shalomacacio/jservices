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
    protected $fillable = ['descricao' ,'flg_comissao'];


    protected $casts = [
        'flg_comissao' => 'boolean'
     ];
}
