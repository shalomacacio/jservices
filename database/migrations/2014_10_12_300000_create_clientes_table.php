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
            $table->integer('user_id');
            $table->string('nome_razaosocial');
            $table->string('cpf');

            $table->string('tel')->nullable();
            $table->string('cel')->nullable();

            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->string('num')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('ponto_ref')->nullable();

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
