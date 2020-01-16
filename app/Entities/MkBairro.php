<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MkBairro.
 *
 * @package namespace App\Entities;
 */
class MkBairro extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $connection = 'pgsql';
    protected $table = "public.mk_bairros";
    protected $primaryKey = 'codbairro';

    protected $fillable = [
      'codbairro',
      'bairro'
    ];


}
