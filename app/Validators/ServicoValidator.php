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
            'comissao_atendimento' => 'numeric',
            'comissao_equipe' => 'numeric',
            'comissao_supervisor' => 'numeric',
            'tip_comiss_atend' => 'required',
            'tip_comiss_eq' => 'required',
            'tip_comiss_sup' => 'required',

        ],
        ValidatorInterface::RULE_UPDATE =>
        [

        ],
    ];
}
