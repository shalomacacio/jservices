<?php

namespace App\Presenters;

use App\Transformers\SolicitacaoStatusTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SolicitacaoStatusPresenter.
 *
 * @package namespace App\Presenters;
 */
class SolicitacaoStatusPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SolicitacaoStatusTransformer();
    }
}
