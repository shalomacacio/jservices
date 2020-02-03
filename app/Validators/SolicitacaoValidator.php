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
            'dt_agendamento'        => 'required|date',
            'user_atendimento_id'   => 'required',
            'origem_venda_id'       => 'required',
            'categoria_servico_id'  => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
