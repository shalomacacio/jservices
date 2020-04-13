<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Carbon\Carbon;

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
    protected $fillable =
    [
      'dt_hr_limite_fim_processo'

    ];


    public function mkPessoa()
    {
      return $this->belongsTo('App\Entities\MkPessoa', 'cliente_cadastrado');
    }

    public function mkProcesso()
    {
      return $this->belongsTo('App\Entities\MkAteProcesso', 'cd_processo', 'codprocesso');
    }

    public function mkConexao()
    {
      return $this->belongsTo('App\Entities\MkConexoes', 'conexao', 'codconexao');
    }

    // public function getTempoAttribute()
    // {

    //     $dataFinal = Carbon::createFromFormat('Y-m-d H:i:s', $this->dtAbertura );
    //     $tempo = $dataFinal->diffInDays(Carbon::now());
    //     if($tempo <= 0){
    //         $tempo = $dataFinal->diffInHours(Carbon::now());
    //         return "Faltam:".$tempo." horas";
    //     }
    //     return dd($dataFinal);
    // }


  //   protected $dates = [
  //     'dt_hr_limite_fim_processo',
  // ];

}
