<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Report;

/**
 * Class ReportTransformer.
 *
 * @package namespace App\Transformers;
 */
class ReportTransformer extends TransformerAbstract
{
    /**
     * Transform the Report entity.
     *
     * @param \App\Entities\Report $model
     *
     * @return array
     */
    public function transform(Report $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
