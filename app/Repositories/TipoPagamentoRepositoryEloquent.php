<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TipoPagamentoRepository;
use App\Entities\TipoPagamento;
use App\Validators\TipoPagamentoValidator;

/**
 * Class TipoPagamentoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TipoPagamentoRepositoryEloquent extends BaseRepository implements TipoPagamentoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoPagamento::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TipoPagamentoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
