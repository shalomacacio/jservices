<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MkAteProcessoRepository;
use App\Entities\MkAteProcesso;
use App\Validators\MkAteProcessoValidator;

/**
 * Class MkAteProcessoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MkAteProcessoRepositoryEloquent extends BaseRepository implements MkAteProcessoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MkAteProcesso::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MkAteProcessoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
