<?php

namespace App\Presenters;

use App\Transformers\PlanoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PlanoPresenter.
 *
 * @package namespace App\Presenters;
 */
class PlanoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PlanoTransformer();
    }
}
