<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class ServicoValidator.
 *
 * @package namespace App\Validators;
 */
class ServicoValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE =>
        [
            'descricao' => 'required|unique:servicos|max:255',
            'servico_vlr' => 'required|numeric|between:0.00,999.99',
            'pontuacao' => 'required|numeric|between:0.25,4.0',
        ],
        ValidatorInterface::RULE_UPDATE =>
        [

        ],
    ];
}
