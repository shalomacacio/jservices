<?php

namespace App\Presenters;

use App\Transformers\TipoAquisicaoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TipoAquisicaoPresenter.
 *
 * @package namespace App\Presenters;
 */
class TipoAquisicaoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TipoAquisicaoTransformer();
    }
}
