<?php

namespace App\Presenters;

use App\Transformers\CategoriaServicosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CategoriaServicosPresenter.
 *
 * @package namespace App\Presenters;
 */
class CategoriaServicosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CategoriaServicosTransformer();
    }
}
