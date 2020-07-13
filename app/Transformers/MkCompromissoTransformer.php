<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MkCompromisso;

/**
 * Class MkCompromissoTransformer.
 *
 * @package namespace App\Transformers;
 */
class MkCompromissoTransformer extends TransformerAbstract
{
    /**
     * Transform the MkCompromisso entity.
     *
     * @param \App\Entities\MkCompromisso $model
     *
     * @return array
     */
    public function transform(MkCompromisso $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
