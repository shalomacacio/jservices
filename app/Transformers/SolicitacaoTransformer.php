<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Solicitacao;

/**
 * Class SolicitacaoTransformer.
 *
 * @package namespace App\Transformers;
 */
class SolicitacaoTransformer extends TransformerAbstract
{
    /**
     * Transform the Solicitacao entity.
     *
     * @param \App\Entities\Solicitacao $model
     *
     * @return array
     */
    public function transform(Solicitacao $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
