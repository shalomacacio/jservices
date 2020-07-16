<?php

namespace App\Presenters;

use App\Transformers\MkAgendaGrupoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MkAgendaGrupoPresenter.
 *
 * @package namespace App\Presenters;
 */
class MkAgendaGrupoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MkAgendaGrupoTransformer();
    }
}
