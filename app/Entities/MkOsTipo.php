<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MkOsTipo.
 *
 * @package namespace App\Entities;
 */
class MkOsTipo extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'pgsql';
    protected $table = "public.mk_os_tipo";
    protected $primaryKey = 'codostipo';
    protected $fillable = ['codostipo', 'descricao'];

}
