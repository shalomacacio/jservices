<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEscalasTable.
 */
class CreateEscalasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('escalas', function(Blueprint $table) {
      $table->increments('id');
      $table->date('dt_escala');

      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')->references('id')
            ->on('users');

      $table->integer('solicitacao_id')->unsigned()->nullable();
      $table->foreign('solicitacao_id')->references('id')
            ->on('solicitacaos');

      $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('escalas');
	}
}
