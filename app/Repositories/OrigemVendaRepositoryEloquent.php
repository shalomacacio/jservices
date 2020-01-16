<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrigemVendaRepository;
use App\Entities\OrigemVenda;
use App\Validators\OrigemVendaValidator;

/**
 * Class OrigemVendaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrigemVendaRepositoryEloquent extends BaseRepository implements OrigemVendaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrigemVenda::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OrigemVendaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
