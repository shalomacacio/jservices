<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SolicitacaoRepository;
use App\Entities\Solicitacao;
use App\Validators\SolicitacaoValidator;

/**
 * Class SolicitacaoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SolicitacaoRepositoryEloquent extends BaseRepository implements SolicitacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Solicitacao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SolicitacaoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
