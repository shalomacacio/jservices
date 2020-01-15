<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePlanosTable.
 */
class CreatePlanosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('planos', function(Blueprint $table) {
            $table->increments('id');
            $table->text('descricao');
            $table->decimal('vlr_plano'); //servico_vlr
            $table->tinyInteger('flg_ativo')->default(0);
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
		Schema::drop('planos');
	}
}
