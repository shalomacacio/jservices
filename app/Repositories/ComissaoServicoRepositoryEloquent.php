<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ComissaoServicoRepository;
use App\Entities\ComissaoServico;
use App\Validators\ComissaoServicoValidator;

/**
 * Class ComissaoServicoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ComissaoServicoRepositoryEloquent extends BaseRepository implements ComissaoServicoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ComissaoServico::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ComissaoServicoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
