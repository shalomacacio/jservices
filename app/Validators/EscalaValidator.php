<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class EscalaValidator.
 *
 * @package namespace App\Validators;
 */
class EscalaValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
          'dt_escala'=>'required|unique:escalas'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];

    protected $messages = [
      'dt_escala.unique' => 'Esta Escala já existe',
    ];
}
