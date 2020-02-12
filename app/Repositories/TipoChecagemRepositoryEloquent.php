<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TipoChecagemRepository;
use App\Entities\TipoChecagem;
use App\Validators\TipoChecagemValidator;

/**
 * Class TipoChecagemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TipoChecagemRepositoryEloquent extends BaseRepository implements TipoChecagemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoChecagem::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TipoChecagemValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
