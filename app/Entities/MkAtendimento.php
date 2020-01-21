<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MkAtendimento.
 *
 * @package namespace App\Entities;
 */
class MkAtendimento extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $connection = 'pgsql';
    protected $table = "public.mk_atendimento";
    protected $primaryKey = 'codatendimento';
    protected $fillable = [];


    public function mkPessoa()
    {
      return $this->belongsTo('App\Entities\MkPessoa', 'cliente_cadastrado');
    }

    public function mkProcesso()
    {
      return $this->belongsTo('App\Entities\MkAteProcesso', 'cd_processo', 'codprocesso');
    }

}
