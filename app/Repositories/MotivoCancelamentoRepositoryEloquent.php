<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MotivoCancelamentoRepository;
use App\Entities\MotivoCancelamento;
use App\Validators\MotivoCancelamentoValidator;

/**
 * Class MotivoCancelamentoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MotivoCancelamentoRepositoryEloquent extends BaseRepository implements MotivoCancelamentoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MotivoCancelamento::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MotivoCancelamentoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
