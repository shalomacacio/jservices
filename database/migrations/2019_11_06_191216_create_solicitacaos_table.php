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

            $table->string('cod_cliente')->nullable();
            $table->string('cliente');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                  ->on('users');

            $table->integer('servico_id')->unsigned()->nullable();
            $table->foreign('servico_id')->references('id')
                  ->on('servicos');

            $table->decimal('servico_vlr')->default(0.00); //servico_vlr

            $table->integer('tecnologia_id')->unsigned()->nullable();
            $table->foreign('tecnologia_id')->references('id')
                  ->on('tecnologias');

            $table->integer('status_solicitacao_id')->unsigned()->default(1);
            $table->foreign('status_solicitacao_id')->references('id')
                  ->on('status_solicitacaos');
            // 1 - aberto
            // 2 - encaminhado
            // 3 - concluido
            // 4 - cancelado
            // 5 - pendente

            $table->timestamp('dt_agendamento')->nullable();
            $table->timestamp('dt_conclusao')->nullable();

            $table->integer('tipo_pagamento_id')->unsigned()->nullable();
            $table->foreign('tipo_pagamento_id')->references('id')->on('tipo_pagamentos');

            $table->integer('tipo_midia_id')->unsigned()->nullable();
            $table->foreign('tipo_midia_id')->references('id')->on('tipo_midias');

            $table->integer('tipo_aquisicao_id')->unsigned()->nullable();
            $table->foreign('tipo_aquisicao_id')->references('id')->on('tipo_aquisicaos');

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
