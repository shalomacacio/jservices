<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Plano;

/**
 * Class PlanoTransformer.
 *
 * @package namespace App\Transformers;
 */
class PlanoTransformer extends TransformerAbstract
{
    /**
     * Transform the Plano entity.
     *
     * @param \App\Entities\Plano $model
     *
     * @return array
     */
    public function transform(Plano $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
