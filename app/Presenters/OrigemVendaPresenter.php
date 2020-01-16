<?php

namespace App\Presenters;

use App\Transformers\OrigemVendaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrigemVendaPresenter.
 *
 * @package namespace App\Presenters;
 */
class OrigemVendaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrigemVendaTransformer();
    }
}
