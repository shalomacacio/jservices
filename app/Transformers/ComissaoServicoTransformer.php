<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ComissaoServico;

/**
 * Class ComissaoServicoTransformer.
 *
 * @package namespace App\Transformers;
 */
class ComissaoServicoTransformer extends TransformerAbstract
{
    /**
     * Transform the ComissaoServico entity.
     *
     * @param \App\Entities\ComissaoServico $model
     *
     * @return array
     */
    public function transform(ComissaoServico $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
