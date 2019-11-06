<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Servico;

/**
 * Class ServicoTransformer.
 *
 * @package namespace App\Transformers;
 */
class ServicoTransformer extends TransformerAbstract
{
    /**
     * Transform the Servico entity.
     *
     * @param \App\Entities\Servico $model
     *
     * @return array
     */
    public function transform(Servico $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
