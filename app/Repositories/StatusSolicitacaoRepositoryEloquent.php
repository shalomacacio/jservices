<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StatusSolicitacaoRepository;
use App\Entities\StatusSolicitacao;
use App\Validators\StatusSolicitacaoValidator;

/**
 * Class StatusSolicitacaoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StatusSolicitacaoRepositoryEloquent extends BaseRepository implements StatusSolicitacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StatusSolicitacao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return StatusSolicitacaoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
