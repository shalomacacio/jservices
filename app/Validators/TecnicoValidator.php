<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class TecnicoValidator.
 *
 * @package namespace App\Validators;
 */
class TecnicoValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE =>
        [
            'nome'      => 'required|unique:tecnicos|max:255',
            'sobrenome' => 'required|max:255',
            'email'     => 'email|unique:tecnicos',
            'telefone'  => 'required|numeric',

        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
