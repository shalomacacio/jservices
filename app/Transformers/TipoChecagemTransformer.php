<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\TipoChecagem;

/**
 * Class TipoChecagemTransformer.
 *
 * @package namespace App\Transformers;
 */
class TipoChecagemTransformer extends TransformerAbstract
{
    /**
     * Transform the TipoChecagem entity.
     *
     * @param \App\Entities\TipoChecagem $model
     *
     * @return array
     */
    public function transform(TipoChecagem $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
