<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Tecnologia;

/**
 * Class TecnologiaTransformer.
 *
 * @package namespace App\Transformers;
 */
class TecnologiaTransformer extends TransformerAbstract
{
    /**
     * Transform the Tecnologia entity.
     *
     * @param \App\Entities\Tecnologia $model
     *
     * @return array
     */
    public function transform(Tecnologia $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
