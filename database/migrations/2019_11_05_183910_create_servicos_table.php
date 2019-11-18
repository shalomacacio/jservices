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

            $table->integer('categoria_servico_id')->unsigned();// Id da tabela categories
            $table->foreign('categoria_servico_id')->references('id')->on('categoria_servicos'); // Define o campo como chave extrangeira (foreign key)

            $table->string('descricao')->unique();
            $table->decimal('servico_vlr')->default(0.00);


			$table->decimal('comissao_atendimento')->default(0); // em percentual %
			$table->string('tip_comiss_atend')->notNul();
			$table->decimal('comissao_equipe')->default(0); // em percentual %
			$table->string('tip_comiss_eq')->notNul();
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
