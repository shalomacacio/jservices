<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\TipoComissao;

/**
 * Class TipoComissaoTransformer.
 *
 * @package namespace App\Transformers;
 */
class TipoComissaoTransformer extends TransformerAbstract
{
    /**
     * Transform the TipoComissao entity.
     *
     * @param \App\Entities\TipoComissao $model
     *
     * @return array
     */
    public function transform(TipoComissao $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
