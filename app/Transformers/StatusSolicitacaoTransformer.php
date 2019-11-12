<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\StatusSolicitacao;

/**
 * Class StatusSolicitacaoTransformer.
 *
 * @package namespace App\Transformers;
 */
class StatusSolicitacaoTransformer extends TransformerAbstract
{
    /**
     * Transform the StatusSolicitacao entity.
     *
     * @param \App\Entities\StatusSolicitacao $model
     *
     * @return array
     */
    public function transform(StatusSolicitacao $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
