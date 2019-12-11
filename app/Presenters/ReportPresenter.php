<?php

namespace App\Presenters;

use App\Transformers\ReportTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ReportPresenter.
 *
 * @package namespace App\Presenters;
 */
class ReportPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ReportTransformer();
    }
}
