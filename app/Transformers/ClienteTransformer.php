<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Cliente;

/**
 * Class ClienteTransformer.
 *
 * @package namespace App\Transformers;
 */
class ClienteTransformer extends TransformerAbstract
{
    /**
     * Transform the Cliente entity.
     *
     * @param \App\Entities\Cliente $model
     *
     * @return array
     */
    public function transform(Cliente $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
