<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Escala.
 *
 * @package namespace App\Entities;
 */
class Escala extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dt_escala'];


    public function users(){
      return $this->hasMany('App\Entities\User');
    }



}
