<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\TipoMidia;

/**
 * Class TipoMidiaTransformer.
 *
 * @package namespace App\Transformers;
 */
class TipoMidiaTransformer extends TransformerAbstract
{
    /**
     * Transform the TipoMidia entity.
     *
     * @param \App\Entities\TipoMidia $model
     *
     * @return array
     */
    public function transform(TipoMidia $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
