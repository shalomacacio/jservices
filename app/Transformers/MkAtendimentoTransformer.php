<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MkAtendimento;

/**
 * Class MkAtendimentoTransformer.
 *
 * @package namespace App\Transformers;
 */
class MkAtendimentoTransformer extends TransformerAbstract
{
    /**
     * Transform the MkAtendimento entity.
     *
     * @param \App\Entities\MkAtendimento $model
     *
     * @return array
     */
    public function transform(MkAtendimento $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
