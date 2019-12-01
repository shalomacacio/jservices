<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TipoComissaoRepository;
use App\Entities\TipoComissao;
use App\Validators\TipoComissaoValidator;

/**
 * Class TipoComissaoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TipoComissaoRepositoryEloquent extends BaseRepository implements TipoComissaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoComissao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TipoComissaoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
