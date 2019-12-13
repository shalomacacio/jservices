<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EscalaRepository;
use App\Entities\Escala;
use App\Entities\User;

use App\Validators\EscalaValidator;

/**
 * Class EscalaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EscalaRepositoryEloquent extends BaseRepository implements EscalaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Escala::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return EscalaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

      public function createHasMany($request){
        $users = User::find($request['users']);
        $escala = new Escala();
        $escala->dt_escala = $request['dt_escala'];
        $escala->save();
        $escala->users()->attach($users);
    }

    public function updateHasMany($request, $id){

      $escala = Escala::find($id);
      $escala->users()->detach();
      $escala->dt_escala = $request['dt_escala'];
      $escala->save();
      $escala->users()->attach($request['users']);
  }

}
