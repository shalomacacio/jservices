<?php

namespace App\Presenters;

use App\Transformers\MotivoCancelamentoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MotivoCancelamentoPresenter.
 *
 * @package namespace App\Presenters;
 */
class MotivoCancelamentoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MotivoCancelamentoTransformer();
    }
}
