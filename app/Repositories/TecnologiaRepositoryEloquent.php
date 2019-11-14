<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TecnologiaRepository;
use App\Entities\Tecnologia;
use App\Validators\TecnologiaValidator;

/**
 * Class TecnologiaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TecnologiaRepositoryEloquent extends BaseRepository implements TecnologiaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tecnologia::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TecnologiaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
