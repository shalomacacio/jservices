<?php

namespace App\Presenters;

use App\Transformers\PesquisaSatisfacaoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PesquisaSatisfacaoPresenter.
 *
 * @package namespace App\Presenters;
 */
class PesquisaSatisfacaoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PesquisaSatisfacaoTransformer();
    }
}
