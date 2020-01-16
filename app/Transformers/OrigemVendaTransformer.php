<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\OrigemVenda;

/**
 * Class OrigemVendaTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrigemVendaTransformer extends TransformerAbstract
{
    /**
     * Transform the OrigemVenda entity.
     *
     * @param \App\Entities\OrigemVenda $model
     *
     * @return array
     */
    public function transform(OrigemVenda $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
