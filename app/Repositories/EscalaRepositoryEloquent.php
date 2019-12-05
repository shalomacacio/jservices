<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EscalaRepository;
use App\Entities\Escala;
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
    
}
