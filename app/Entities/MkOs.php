<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MkOs.
 *
 * @package namespace App\Entities;
 */
class MkOs extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $connection = 'pgsql';
    protected $table = "public.mk_os";
    protected $primaryKey = 'codos';
    protected $fillable = ['tecncico_responsavel'];

    public function mkAtendimento()
    {
      return $this->belongsTo('App\Entities\MkAtendimento', 'cd_processo', 'codprocesso');
    }

    public function mkPessoa()
    {
        return $this->belongsTo('App\Entities\MkPessoa', 'cliente', 'codpessoa');
    }

    public function consultor()
    {
        return $this->belongsTo('App\Entities\MkPessoa','tecnico_responsavel', 'codpessoa' );
    }

    public function tecnico()
    {
        return $this->belongsTo('App\Entities\MkPessoa','tecnico_atendimento', 'codpessoa' );
    }

    public function mkOsTipo()
    {
        return $this->belongsTo('App\Entities\mkOsTipo', 'tipo_os', 'codostipo');
    }

    public function mkConexao()
    {
        return $this->belongsTo('App\Entities\mkConexoes', 'conexao_associada', 'codconexao');
    }

}
