<?php

namespace App\Presenters;

use App\Transformers\MkOsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MkOsPresenter.
 *
 * @package namespace App\Presenters;
 */
class MkOsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MkOsTransformer();
    }
}
