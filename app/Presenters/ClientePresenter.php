<?php

namespace App\Presenters;

use App\Transformers\ClienteTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ClientePresenter.
 *
 * @package namespace App\Presenters;
 */
class ClientePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ClienteTransformer();
    }
}
