<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cliente.
 *
 * @package namespace App\Entities;
 */
class Cliente extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $connection = 'pgsql';
    // protected $table = "public.mk_pessoas";
    protected $fillable = [
      'codpessoa' ,
      'nome_razaosocial',
      'dt_nascimento',
      'cpf',
      'tel',
      'cel',
      'endereco',
      'num',
      'bairro',
      'cidade',
      'user_id'
    ];

}
