<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateClientesTable.
 */
class CreateClientesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clientes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('codpessoa')->nullable();
            $table->string('nome_razaosocial');
            $table->date('dt_nascimento');
            $table->string('cpf');

            $table->string('endereco');
            $table->string('num');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('ponto_ref')->nullable();

            $table->string('tel')->nullable();
            $table->string('cel')->nullable();

            $table->integer('user_id');
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
		Schema::drop('clientes');
	}
}
