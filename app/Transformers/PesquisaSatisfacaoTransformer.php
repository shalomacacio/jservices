<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\PesquisaSatisfacao;

/**
 * Class PesquisaSatisfacaoTransformer.
 *
 * @package namespace App\Transformers;
 */
class PesquisaSatisfacaoTransformer extends TransformerAbstract
{
    /**
     * Transform the PesquisaSatisfacao entity.
     *
     * @param \App\Entities\PesquisaSatisfacao $model
     *
     * @return array
     */
    public function transform(PesquisaSatisfacao $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
