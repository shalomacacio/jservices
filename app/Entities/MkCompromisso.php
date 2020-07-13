<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MkCompromisso.
 *
 * @package namespace App\Entities;
 */
class MkCompromisso extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $connection = 'pgsql';
    protected $table = "public.mk_compromissos";
    protected $primaryKey = 'codcompromisso';
    protected $fillable = [];

    public function mkOs()
    {
      return $this->belongsTo('App\Entities\MkOs', 'cd_integracao', 'codos');
    }

    public function mkFunncionario()
    {
      return $this->belongsTo('App\Entities\MkPessoa', 'cd_funcionario', 'codpessoa');
    }

}
