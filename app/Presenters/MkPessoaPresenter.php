<?php

namespace App\Presenters;

use App\Transformers\MkPessoaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MkPessoaPresenter.
 *
 * @package namespace App\Presenters;
 */
class MkPessoaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MkPessoaTransformer();
    }
}
