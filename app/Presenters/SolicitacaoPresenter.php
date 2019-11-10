<?php

namespace App\Presenters;

use App\Transformers\SolicitacaoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SolicitacaoPresenter.
 *
 * @package namespace App\Presenters;
 */
class SolicitacaoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SolicitacaoTransformer();
    }
}
