<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MkPessoa;

/**
 * Class MkPessoaTransformer.
 *
 * @package namespace App\Transformers;
 */
class MkPessoaTransformer extends TransformerAbstract
{
    /**
     * Transform the MkPessoa entity.
     *
     * @param \App\Entities\MkPessoa $model
     *
     * @return array
     */
    public function transform(MkPessoa $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
