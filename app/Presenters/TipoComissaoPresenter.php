<?php

namespace App\Presenters;

use App\Transformers\TipoComissaoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TipoComissaoPresenter.
 *
 * @package namespace App\Presenters;
 */
class TipoComissaoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TipoComissaoTransformer();
    }
}
