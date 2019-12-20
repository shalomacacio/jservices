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


    public function createComissaoAtendimeto($solicitacao)
    {
      $comissao = new Comissao();
      $comissao->dt_referencia = $solicitacao->created_at;
      $comissao->funcionario_id = $solicitacao->user_id;
      $comissao->solicitacao_id = $solicitacao->id;
      $comissao->servico_id = $solicitacao->servico->id;
      $comissao->servico_vlr = $solicitacao->servico->servico_vlr;
      $comissao->servico_comissao = $solicitacao->servico->comissao_atendimento;
      $comissao->servico_tipo_comissao_id = $solicitacao->servico->tipo_comissao_atendimento;
      $comissao->comissao_vlr = $comissao->comissionar($comissao->servico_vlr, $comissao->servico_comissao, $comissao->servico_tipo_comissao_id);
      $comissao->save();
    }

    public function updateComissaoAtendimeto($solicitacao)
    {
      $comissao = Comissao::where('solicitacao_id', $solicitacao->id)->where('funcionario_id', $solicitacao->user_id)->get();
      $this->deleteComissaoIndividual($solicitacao->id, $solicitacao->user_id);
      $this->createComissaoAtendimeto($solicitacao);
    }

    public function createComissaoEquipe($solicitacao)
    {

      foreach( $solicitacao->users as $tecnico ){

        $comissao = new Comissao();
        $comissao->dt_referencia = $solicitacao->dt_conclusao;
        $comissao->funcionario_id = $tecnico->id;
        $comissao->solicitacao_id = $solicitacao->id;
        $comissao->servico_id = $solicitacao->servico->id;
        $comissao->servico_vlr = $solicitacao->servico->servico_vlr;
        $comissao->servico_comissao = $solicitacao->servico->comissao_equipe;
        $comissao->servico_tipo_comissao_id = $solicitacao->servico->tipo_comissao_equipe;
        $comissao->comissao_vlr = $comissao->comissionar($comissao->servico_vlr, $comissao->servico_comissao, $comissao->servico_tipo_comissao_id)/count($solicitacao->users);
        $comissao->save();
      }
    }

    public function deleteComissaoIndividual($solicitacaoId, $usuarioId){
      $deletedRows = Comissao::where('solicitacao_id', $solicitacaoId)->where('funcionario_id', $usuarioId)->delete();
    }

    public function deleteComissaoGrupo($solicitacaoId){
      $deletedRows = Comissao::where('solicitacao_id', $solicitacaoId)->delete();
    }

}
