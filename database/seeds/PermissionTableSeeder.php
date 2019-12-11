<?php

use Illuminate\Database\Seeder;
use Artesaos\Defender\Facades\Defender;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->createPermission();
    }

    private function createPermission()
    {
      //users permissions
      $user_create_permission =  Defender::createPermission('user.create', 'Criar usuario');
      $user_update_permission =  Defender::createPermission('user.update', 'Alterar usuario');
      $user_delete_permission =  Defender::createPermission('user.delete', 'Deletar usuario');
      $user_list_permission =  Defender::createPermission('user.index',   'Listar usuario');
      $user_show_permission =  Defender::createPermission('user.show',   'Visualizar usuario');

      //solicitacao permissions
      $solicitacao_create_permission =  Defender::createPermission('solicitacao.create',   'Criar solicitacao');
      $solicitacao_create_permission =  Defender::createPermission('solicitacao.update',  'Alterar solicitacao');
      $solicitacao_create_permission =  Defender::createPermission('solicitacao.delete',  'Deletar solicitacao');
      $solicitacao_create_permission =  Defender::createPermission('solicitacao.index',   'Listar solicitacao');
      $solicitacao_create_permission =  Defender::createPermission('solicitacao.show','Visualizar solicitacao');
      $solicitacao_solicitacoes_permission =  Defender::createPermission('solicitacao.solicitacoes','Solicitacoes');
      $solicitacao_encaminhar_permission =  Defender::createPermission('solicitacao.encaminhar','Encaminhar solicitacao');
      $solicitacao_atribuir_permission =  Defender::createPermission('solicitacao.atribuir','Atribuir solicitacao');
      $solicitacao_concluir_permission =  Defender::createPermission('solicitacao.concluir','Concluir solicitacao');

      $tecnologia_create_permission =  Defender::createPermission('tecnologia.create', 'Criar tecnologia');
      $tecnologia_update_permission =  Defender::createPermission('tecnologia.update', 'Alterar tecnologia');
      $tecnologia_delete_permission =  Defender::createPermission('tecnologia.delete', 'Deletar tecnologia');
      $tecnologia_list_permission =  Defender::createPermission('tecnologia.index',   'Listar tecnologia');
      $tecnologia_show_permission =  Defender::createPermission('tecnologia.show',   'Visualizar tecnologia');

      $servicos_create_permission =  Defender::createPermission('servicos.create', 'Criar servicos');
      $servicos_update_permission =  Defender::createPermission('servicos.update', 'Alterar servicos');
      $servicos_delete_permission =  Defender::createPermission('servicos.delete', 'Deletar servicos');
      $servicos_list_permission =  Defender::createPermission('servicos.index',   'Listar servicos');
      $servicos_show_permission =  Defender::createPermission('servicos.show',   'Visualizar servicos');

      $escalas_create_permission =  Defender::createPermission('escalas.create', 'Criar escalas');
      $escalas_update_permission =  Defender::createPermission('escalas.update', 'Alterar escalas');
      $escalas_delete_permission =  Defender::createPermission('escalas.delete', 'Deletar escalas');
      $escalas_list_permission =  Defender::createPermission('escalas.index',   'Listar escalas');
      $escalas_show_permission =  Defender::createPermission('escalas.show',   'Visualizar escalas');

    }
}
