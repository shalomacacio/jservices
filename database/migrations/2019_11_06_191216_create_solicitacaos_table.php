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
            // 3 - cancelado
            // 4 - concluido
            // 5 - pendente

            $table->string('forma_pagamento')->nullable();
            $table->string('tipo_aquisicao')->nullable();

            $table->decimal('comissao_atendimento')->default(0.00);
            $table->decimal('comissao_equipe')->default(0.00);
            $table->decimal('comissao_supervisor')->default(0.00);

            $table->tinyInteger('flg_autorizado')->nullable()->default(null);
            $table->text('obs')->nullable();

            //campos padrao
            $table->rememberToken();
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
