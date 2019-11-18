<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\CategoriaServicos;

/**
 * Class CategoriaServicosTransformer.
 *
 * @package namespace App\Transformers;
 */
class CategoriaServicosTransformer extends TransformerAbstract
{
    /**
     * Transform the CategoriaServicos entity.
     *
     * @param \App\Entities\CategoriaServicos $model
     *
     * @return array
     */
    public function transform(CategoriaServicos $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
