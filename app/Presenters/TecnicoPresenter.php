<?php

namespace App\Presenters;

use App\Transformers\TecnicoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TecnicoPresenter.
 *
 * @package namespace App\Presenters;
 */
class TecnicoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TecnicoTransformer();
    }
}
