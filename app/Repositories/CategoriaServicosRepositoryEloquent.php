<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CategoriaServicosRepository;
use App\Entities\CategoriaServicos;
use App\Validators\CategoriaServicosValidator;

/**
 * Class CategoriaServicosRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoriaServicosRepositoryEloquent extends BaseRepository implements CategoriaServicosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoriaServicos::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CategoriaServicosValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
