<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MkBairro;

/**
 * Class MkBairroTransformer.
 *
 * @package namespace App\Transformers;
 */
class MkBairroTransformer extends TransformerAbstract
{
    /**
     * Transform the MkBairro entity.
     *
     * @param \App\Entities\MkBairro $model
     *
     * @return array
     */
    public function transform(MkBairro $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
