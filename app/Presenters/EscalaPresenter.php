<?php

namespace App\Presenters;

use App\Transformers\EscalaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EscalaPresenter.
 *
 * @package namespace App\Presenters;
 */
class EscalaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EscalaTransformer();
    }
}
