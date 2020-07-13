<?php

namespace App\Presenters;

use App\Transformers\MkCompromissoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MkCompromissoPresenter.
 *
 * @package namespace App\Presenters;
 */
class MkCompromissoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MkCompromissoTransformer();
    }
}
