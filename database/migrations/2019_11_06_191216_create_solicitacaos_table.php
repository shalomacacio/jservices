<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSolicitacaosTable.
 */
class CreateSolicitacaosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('solicitacaos', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('cliente_id')->nullable();
            $table->text('codpessoa')->nullable();
            $table->text('nome_razaosocial')->nullable();

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                  ->on('users');

            $table->integer('user_atendimento_id')->unsigned()->nullable();
            $table->foreign('user_atendimento_id')->references('id')
                        ->on('users');

            $table->integer('categoria_servico_id')->unsigned()->nullable();
                  $table->foreign('categoria_servico_id')->references('id')
                    ->on('categoria_servicos');

            $table->integer('servico_id')->unsigned()->nullable();
            $table->integer('plano_id')->unsigned()->nullable();
            $table->integer('plano_ant_id')->unsigned()->nullable();
            $table->decimal('vlr_plano')->default(0.00); //servico_vlr
            $table->decimal('vlr_plano_ant')->default(0.00); //servico_vlr
            $table->decimal('vlr_plano_dif')->default(0.00); //servico_vlr

            $table->tinyInteger('flg_comissao')->default(0);
            $table->integer('tecnologia_id')->unsigned()->nullable();
            $table->integer('status_solicitacao_id')->unsigned()->default(1);
            // 1 - aberto
            // 2 - encaminhado
            // 3 - concluido
            // 4 - cancelado
            // 5 - pendente

            $table->timestamp('dt_agendamento')->nullable();
            $table->timestamp('dt_conclusao')->nullable();
            $table->integer('tipo_pagamento_id')->unsigned()->nullable();
            $table->integer('tipo_midia_id')->unsigned()->nullable();
            $table->integer('tipo_aquisicao_id')->unsigned()->nullable();

            $table->text('obs')->nullable();

            //campos padrao
            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('solicitacaos');
	}
}
