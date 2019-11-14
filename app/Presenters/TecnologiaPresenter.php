<?php

namespace App\Presenters;

use App\Transformers\TecnologiaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TecnologiaPresenter.
 *
 * @package namespace App\Presenters;
 */
class TecnologiaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TecnologiaTransformer();
    }
}
