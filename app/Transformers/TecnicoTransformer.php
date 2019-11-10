<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Tecnico;

/**
 * Class TecnicoTransformer.
 *
 * @package namespace App\Transformers;
 */
class TecnicoTransformer extends TransformerAbstract
{
    /**
     * Transform the Tecnico entity.
     *
     * @param \App\Entities\Tecnico $model
     *
     * @return array
     */
    public function transform(Tecnico $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
