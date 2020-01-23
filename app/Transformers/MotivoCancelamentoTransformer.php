<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MotivoCancelamento;

/**
 * Class MotivoCancelamentoTransformer.
 *
 * @package namespace App\Transformers;
 */
class MotivoCancelamentoTransformer extends TransformerAbstract
{
    /**
     * Transform the MotivoCancelamento entity.
     *
     * @param \App\Entities\MotivoCancelamento $model
     *
     * @return array
     */
    public function transform(MotivoCancelamento $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
