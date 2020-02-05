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
    protected $fillable = [];

    public function mkAtendimento()
    {
      return $this->belongsTo('App\Entities\MkAtendimento', 'cd_processo', 'codprocesso');
    }

}
