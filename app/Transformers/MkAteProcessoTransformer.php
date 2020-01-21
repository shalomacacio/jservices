<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MkAteProcesso;

/**
 * Class MkAteProcessoTransformer.
 *
 * @package namespace App\Transformers;
 */
class MkAteProcessoTransformer extends TransformerAbstract
{
    /**
     * Transform the MkAteProcesso entity.
     *
     * @param \App\Entities\MkAteProcesso $model
     *
     * @return array
     */
    public function transform(MkAteProcesso $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
