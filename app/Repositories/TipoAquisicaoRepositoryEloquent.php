<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TipoAquisicaoRepository;
use App\Entities\TipoAquisicao;
use App\Validators\TipoAquisicaoValidator;

/**
 * Class TipoAquisicaoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TipoAquisicaoRepositoryEloquent extends BaseRepository implements TipoAquisicaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoAquisicao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TipoAquisicaoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
