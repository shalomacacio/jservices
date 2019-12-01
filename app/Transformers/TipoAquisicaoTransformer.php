<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\TipoAquisicao;

/**
 * Class TipoAquisicaoTransformer.
 *
 * @package namespace App\Transformers;
 */
class TipoAquisicaoTransformer extends TransformerAbstract
{
    /**
     * Transform the TipoAquisicao entity.
     *
     * @param \App\Entities\TipoAquisicao $model
     *
     * @return array
     */
    public function transform(TipoAquisicao $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
