<?php

namespace App\Presenters;

use App\Transformers\TipoUsuarioTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TipoUsuarioPresenter.
 *
 * @package namespace App\Presenters;
 */
class TipoUsuarioPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TipoUsuarioTransformer();
    }
}
