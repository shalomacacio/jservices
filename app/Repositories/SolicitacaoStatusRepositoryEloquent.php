<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SolicitacaoStatusRepository;
use App\Entities\SolicitacaoStatus;
use App\Validators\SolicitacaoStatusValidator;

/**
 * Class SolicitacaoStatusRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SolicitacaoStatusRepositoryEloquent extends BaseRepository implements SolicitacaoStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SolicitacaoStatus::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SolicitacaoStatusValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
