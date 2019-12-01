<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TipoUsuarioRepository;
use App\Entities\TipoUsuario;
use App\Validators\TipoUsuarioValidator;

/**
 * Class TipoUsuarioRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TipoUsuarioRepositoryEloquent extends BaseRepository implements TipoUsuarioRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoUsuario::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TipoUsuarioValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
