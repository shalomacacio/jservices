<?php

namespace App\Presenters;

use App\Transformers\MkAteProcessoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MkAteProcessoPresenter.
 *
 * @package namespace App\Presenters;
 */
class MkAteProcessoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MkAteProcessoTransformer();
    }
}
