<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\TipoPagamento;

/**
 * Class TipoPagamentoTransformer.
 *
 * @package namespace App\Transformers;
 */
class TipoPagamentoTransformer extends TransformerAbstract
{
    /**
     * Transform the TipoPagamento entity.
     *
     * @param \App\Entities\TipoPagamento $model
     *
     * @return array
     */
    public function transform(TipoPagamento $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
