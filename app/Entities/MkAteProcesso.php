<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MkAteProcesso.
 *
 * @package namespace App\Entities;
 */
class MkAteProcesso extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'pgsql';
    protected $table = "public.mk_ate_processos";
    protected $primaryKey = 'codprocesso';
    protected $fillable = [];

}
