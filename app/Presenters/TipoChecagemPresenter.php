<?php

namespace App\Presenters;

use App\Transformers\TipoChecagemTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TipoChecagemPresenter.
 *
 * @package namespace App\Presenters;
 */
class TipoChecagemPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TipoChecagemTransformer();
    }
}
