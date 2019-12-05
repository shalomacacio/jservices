<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Escala;

/**
 * Class EscalaTransformer.
 *
 * @package namespace App\Transformers;
 */
class EscalaTransformer extends TransformerAbstract
{
    /**
     * Transform the Escala entity.
     *
     * @param \App\Entities\Escala $model
     *
     * @return array
     */
    public function transform(Escala $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
