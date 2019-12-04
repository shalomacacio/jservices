<?php

namespace App\Presenters;

use App\Transformers\ComissaoServicoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ComissaoServicoPresenter.
 *
 * @package namespace App\Presenters;
 */
class ComissaoServicoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ComissaoServicoTransformer();
    }
}
