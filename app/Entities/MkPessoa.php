<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MkPessoa.
 *
 * @package namespace App\Entities;
 */
class MkPessoa extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'pgsql';
    protected $table = "public.mk_pessoas";
    protected $primaryKey = 'codpessoa';

    protected $fillable = [
      'nome_razaosocial',
      'codbairro'
    ];

    public function bairro()
    {
        return $this->belongsTo('App\Entities\MkBairro', 'codbairro');
    }

}
