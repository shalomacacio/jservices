<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTecnicosTable.
 */
class CreateTecnicosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tecnicos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 50);
            $table->string('sobrenome', 50);
            $table->tinyInteger('flg_ativo')->default(1);
            //campos de autenticação
            $table->string('email', 80)->unique();
            $table->string('telefone')->unique();
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
		Schema::drop('tecnicos');
	}
}
