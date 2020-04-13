<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MkConexoesRepository;
use App\Entities\MkConexoes;
use App\Validators\MkConexoesValidator;

/**
 * Class MkConexoesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MkConexoesRepositoryEloquent extends BaseRepository implements MkConexoesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MkConexoes::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
