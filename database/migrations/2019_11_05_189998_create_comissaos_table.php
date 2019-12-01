<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateComissaosTable.
 */
class CreateComissaosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comissaos', function(Blueprint $table) {
            $table->increments('id');
            $table->text('descricao');
            $table->decimal('valor')->default(0.00);
            $table->tinyInteger('tipo_comissao_id');
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
		Schema::drop('comissaos');
	}
}
