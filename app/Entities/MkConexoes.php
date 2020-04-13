<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MkConexoes.
 *
 * @package namespace App\Entities;
 */
class MkConexoes extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'pgsql';
    protected $table = "public.mk_conexoes";
    protected $primaryKey = 'codconexao';
    protected $fillable = [];

    public function mkPlanoAcesso()
    {
      return $this->belongsTo('App\Entities\MkPlanoAcesso', 'codplano_acesso', 'codplano');
    }

}
