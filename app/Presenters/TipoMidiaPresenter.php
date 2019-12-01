<?php

namespace App\Presenters;

use App\Transformers\TipoMidiaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TipoMidiaPresenter.
 *
 * @package namespace App\Presenters;
 */
class TipoMidiaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TipoMidiaTransformer();
    }
}
