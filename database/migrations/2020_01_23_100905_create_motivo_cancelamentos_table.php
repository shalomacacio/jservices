<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMotivoCancelamentosTable.
 */
class CreateMotivoCancelamentosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('motivo_cancelamentos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('descricao')->unique();
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
		Schema::drop('motivo_cancelamentos');
	}
}
