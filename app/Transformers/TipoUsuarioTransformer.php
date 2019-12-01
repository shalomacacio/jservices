<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\TipoUsuario;

/**
 * Class TipoUsuarioTransformer.
 *
 * @package namespace App\Transformers;
 */
class TipoUsuarioTransformer extends TransformerAbstract
{
    /**
     * Transform the TipoUsuario entity.
     *
     * @param \App\Entities\TipoUsuario $model
     *
     * @return array
     */
    public function transform(TipoUsuario $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
