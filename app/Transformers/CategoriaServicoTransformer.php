<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\CategoriaServico;

/**
 * Class CategoriaServicoTransformer.
 *
 * @package namespace App\Transformers;
 */
class CategoriaServicoTransformer extends TransformerAbstract
{
    /**
     * Transform the CategoriaServico entity.
     *
     * @param \App\Entities\CategoriaServico $model
     *
     * @return array
     */
    public function transform(CategoriaServico $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
