<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TipoMidiaRepository;
use App\Entities\TipoMidia;
use App\Validators\TipoMidiaValidator;

/**
 * Class TipoMidiaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TipoMidiaRepositoryEloquent extends BaseRepository implements TipoMidiaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoMidia::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TipoMidiaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
