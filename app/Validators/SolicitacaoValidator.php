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
            'nome_razaosocial'      => 'required|max:255',

        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
