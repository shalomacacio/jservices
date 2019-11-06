<?php

namespace App\Presenters;

use App\Transformers\ServicoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ServicoPresenter.
 *
 * @package namespace App\Presenters;
 */
class ServicoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ServicoTransformer();
    }
}
