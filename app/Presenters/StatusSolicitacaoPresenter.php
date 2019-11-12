<?php

namespace App\Presenters;

use App\Transformers\StatusSolicitacaoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StatusSolicitacaoPresenter.
 *
 * @package namespace App\Presenters;
 */
class StatusSolicitacaoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StatusSolicitacaoTransformer();
    }
}
