<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateServicosTable.
 */
class CreateServicosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('servicos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('descricao')->unique();
			$table->decimal('comissao_atendimento')->default(0); // em percentual %
			$table->string('tip_comiss_atend')->notNul();
			$table->decimal('comissao_tecnico')->default(0); // em percentual %
			$table->string('tip_comiss_tec')->notNul();
			$table->decimal('comissao_supervisor')->default(0); // em percentual %
			$table->string('tip_comiss_sup')->notNul();
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
		Schema::drop('servicos');
	}
}