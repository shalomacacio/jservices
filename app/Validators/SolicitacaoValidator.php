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
            'codatendimento'        => 'required|unique:solicitacaos',
            'categoria_servico_id'  => 'required',
            'categoria_servico_id'  => 'required',
            'vlr_servico'           => 'numeric',
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];

    protected $messages = [
      'codatendimento.unique' => 'Solicitacao já cadastrada',
      'nome_razaosocial.required' => 'Cliente é obrigatório',
      'codatendimento.required' => 'Cod Atendimento é obrigatório',
      'vlr_servico.numeric' => 'Valor Serviço é numérico. Utilize ponto e não vírgula ',

  ];


}
