<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PesquisaSatisfacaoRepository;
use App\Entities\PesquisaSatisfacao;
use App\Validators\PesquisaSatisfacaoValidator;

/**
 * Class PesquisaSatisfacaoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PesquisaSatisfacaoRepositoryEloquent extends BaseRepository implements PesquisaSatisfacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PesquisaSatisfacao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PesquisaSatisfacaoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
