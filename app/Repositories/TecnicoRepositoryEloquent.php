<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TecnicoRepository;
use App\Entities\Tecnico;
use App\Validators\TecnicoValidator;

/**
 * Class TecnicoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TecnicoRepositoryEloquent extends BaseRepository implements TecnicoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tecnico::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TecnicoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
