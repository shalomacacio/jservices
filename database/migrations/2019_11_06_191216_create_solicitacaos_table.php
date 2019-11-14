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
            $table->integer('user_id');
            $table->integer('servico_id');
            $table->integer('tecnologia_id');
            $table->decimal('servico_vlr')->default(0.00);
            $table->string('forma_pagamento')->nullable();
            $table->string('tipo_aquisicao')->nullable();
            $table->integer('status_solicitacao_id')->default(1);
            $table->decimal('comissao_atendimento')->default(0.00);
            $table->decimal('comissao_equipe')->default(0.00);
            $table->decimal('comissao_supervisor')->default(0.00);
            $table->text('obs')->nullable();
            $table->tinyInteger('flg_autorizado')->nullable()->default(null);

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
