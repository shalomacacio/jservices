<?php

namespace App\Repositories;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ComissaoRepository;
use App\Entities\Comissao;
use App\Validators\ComissaoValidator;
use DB;

/**
 * Class ComissaoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ComissaoRepositoryEloquent extends BaseRepository implements ComissaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comissao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return ComissaoValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createComissao($solicitacao)
    {
      switch ($solicitacao->categoria_servico_id)
      {
        case '1': //ADESÃO
          if($solicitacao->tipo_pagamento_id != 5){
            $this->createComissaoServPago($solicitacao);
          }
          $this->createComissaoAdesao($solicitacao);
          break;
        case '4': //MIGRAÇÃO
          $this->createComissaoAdesao($solicitacao);
           break;
        case '6': //SERV PAGO
          $this->createComissaoServPago($solicitacao);
            break;
        case '8': // TRANSFERENCIA
            // $this->createComissaoServicoAtend($solicitacao);
           $this->createComissaoTransf($solicitacao);
            break;
        case '9': //UPGRADE
            $this->createComissaoAdesao($solicitacao);
              break;
        default:
          # code...
          break;
      }
    }

    public function createComissaoEcex($solicitacao)
    {
      switch ($solicitacao->categoria_servico_id)
      {
        case '1':
          createComissaoExecAdesao($solicitacao);
          break;
        case '2':
          createComissaoExecCancelamento($solicitacao);
            break;
        default:
          # code...
          break;
      }
    }

    public function createComissaoAdesao($solicitacao)
    {
      $comissao = new Comissao();
      $comissao->dt_referencia = $solicitacao->dt_agendamento;
      $comissao->funcionario_id = $solicitacao->user_atendimento_id;
      $comissao->user_id = $solicitacao->user->id;
      $comissao->solicitacao_id = $solicitacao->id;
      $comissao->comissao_vlr = $comissao->comissionar($solicitacao->plano->vlr_plano, 10, 2);
      $comissao->save();
    }

    public function updateComissaoAdesao($solicitacao)
    {
      $this->deleteComissaoIndividual($solicitacao->id, $solicitacao->user_atendimento_id);
      $this->createComissaoAdesao($solicitacao);
    }

    public function createComissaoExecAdesao($solicitacao)
    {
      foreach( $solicitacao->users as $tecnico ){
        $comissao = new Comissao();
        $comissao->dt_referencia = $solicitacao->dt_conclusao;
        $comissao->funcionario_id = $tecnico->id;
        $comissao->user_id = $solicitacao->user->id;
        $comissao->solicitacao_id = $solicitacao->id;
        $comissao->comissao_vlr = $comissao->comissionar($solicitacao->plano->vlr_plano, 8, 1 )/count($solicitacao->users);
        $comissao->save();
      }
    }

    public function createComissaoExecCancelamento($solicitacao)
    {
      // return dd($solicitacao);
      foreach( $solicitacao->users as $tecnico )
      {
        $comissao = new Comissao();
        $comissao->dt_referencia = $solicitacao->dt_conclusao;
        $comissao->funcionario_id = $tecnico->id;
        $comissao->user_id = $solicitacao->user->id;
        $comissao->solicitacao_id = $solicitacao->id;
        $comissao->comissao_vlr = $comissao->comissionar(0, 4, 1 )/count($solicitacao->users);
        $comissao->save();
      }
    }

    public function createComissaoTransf($solicitacao)
    {
      $comissao = new Comissao();
      $comissao->dt_referencia = $solicitacao->dt_agendamento;
      $comissao->funcionario_id = $solicitacao->user_id;
      $comissao->user_id = $solicitacao->user->id;
      $comissao->solicitacao_id = $solicitacao->id;
      $comissao->comissao_vlr = $comissao->comissionar($solicitacao->vlr_servico, 10, 2);
      $comissao->save();
    }

    // public function createComissaoUpgrade($solicitacao)
    // {
    //   $vlr_anterior =
    //   $comissao = new Comissao();
    //   $comissao->dt_referencia = $solicitacao->created_at;
    //   $comissao->funcionario_id = $solicitacao->user_id;
    //   $comissao->solicitacao_id = $solicitacao->id;
    //   $comissao->comissao_vlr = $solicitacao->plano_ant->
    //   $comissao->save();
    // }

    public function createComissaoServicoAtend($solicitacao)
    {
      $comissao = new Comissao();
      $comissao->dt_referencia = $solicitacao->dt_atendimento;
      $comissao->funcionario_id = $solicitacao->user_id;
      $comissao->user_id = $solicitacao->user->id;
      $comissao->solicitacao_id = $solicitacao->id;
      $comissao->comissao_vlr = $comissao->comissionar($solicitacao->servico->servico_vlr, $solicitacao->servico->comissao_atendimento, $solicitacao->servico->tipo_comissao_atendimento);
      $comissao->save();
    }

    public function createComissaoServPago($solicitacao)
    {
      $comissao = new Comissao();
      $comissao->dt_referencia = $solicitacao->dt_atendimento;
      $comissao->funcionario_id = $solicitacao->user_atendimento_id;
      $comissao->user_id = $solicitacao->user->id;
      $comissao->solicitacao_id = $solicitacao->id;
      $comissao->comissao_vlr = $comissao->comissionar($solicitacao->vlr_servico, 10, 2);
      $comissao->save();
    }

    public function updateComissaoAtendimeto($solicitacao)
    {
      $this->deleteComissaoIndividual($solicitacao->id, $solicitacao->user_id);
      $this->createComissaoAtendimeto($solicitacao);
    }

    public function createComissaoEquipe($solicitacao)
    {
      foreach( $solicitacao->users as $tecnico )
      {
        $comissao = new Comissao();
        $comissao->dt_referencia = $solicitacao->dt_conclusao;
        $comissao->funcionario_id = $tecnico->id;
        $comissao->user_id = $solicitacao->user->id;
        $comissao->solicitacao_id = $solicitacao->id;
        $comissao->comissao_vlr = $comissao->comissionar($solicitacao->plano->vlr_plano, 8, 1 )/count($solicitacao->users);
        $comissao->save();
      }
    }

    public function deleteComissaoIndividual($solicitacaoId, $usuarioId)
    {
      $deletedRows = Comissao::where('solicitacao_id', $solicitacaoId)->where('funcionario_id', $usuarioId)->delete();
    }

    public function deleteComissaoGrupo($solicitacaoId)
    {
      $deletedRows = Comissao::where('solicitacao_id', $solicitacaoId)->delete();
    }
}
