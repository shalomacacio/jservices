<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MkAgendaGrupo;

/**
 * Class MkAgendaGrupoTransformer.
 *
 * @package namespace App\Transformers;
 */
class MkAgendaGrupoTransformer extends TransformerAbstract
{
    /**
     * Transform the MkAgendaGrupo entity.
     *
     * @param \App\Entities\MkAgendaGrupo $model
     *
     * @return array
     */
    public function transform(MkAgendaGrupo $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
