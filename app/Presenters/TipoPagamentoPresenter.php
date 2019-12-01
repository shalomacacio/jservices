<?php

namespace App\Presenters;

use App\Transformers\TipoPagamentoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TipoPagamentoPresenter.
 *
 * @package namespace App\Presenters;
 */
class TipoPagamentoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TipoPagamentoTransformer();
    }
}
