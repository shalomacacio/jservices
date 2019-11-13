<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class SolicitacaoValidator.
 *
 * @package namespace App\Validators;
 */
class SolicitacaoValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE =>
        [
            'cliente'      => 'required|max:255',
            'servico_id'   => 'required|numeric',
            'servico_vlr'   => 'required|numeric',

        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
