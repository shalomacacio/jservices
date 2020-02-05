<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MkOs;

/**
 * Class MkOsTransformer.
 *
 * @package namespace App\Transformers;
 */
class MkOsTransformer extends TransformerAbstract
{
    /**
     * Transform the MkOs entity.
     *
     * @param \App\Entities\MkOs $model
     *
     * @return array
     */
    public function transform(MkOs $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
