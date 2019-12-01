<?php

namespace App\Presenters;

use App\Transformers\CategoriaServicoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CategoriaServicoPresenter.
 *
 * @package namespace App\Presenters;
 */
class CategoriaServicoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CategoriaServicoTransformer();
    }
}
