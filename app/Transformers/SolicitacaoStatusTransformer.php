<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\SolicitacaoStatus;

/**
 * Class SolicitacaoStatusTransformer.
 *
 * @package namespace App\Transformers;
 */
class SolicitacaoStatusTransformer extends TransformerAbstract
{
    /**
     * Transform the SolicitacaoStatus entity.
     *
     * @param \App\Entities\SolicitacaoStatus $model
     *
     * @return array
     */
    public function transform(SolicitacaoStatus $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
