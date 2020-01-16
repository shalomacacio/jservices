<?php

namespace App\Presenters;

use App\Transformers\MkBairroTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MkBairroPresenter.
 *
 * @package namespace App\Presenters;
 */
class MkBairroPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MkBairroTransformer();
    }
}
