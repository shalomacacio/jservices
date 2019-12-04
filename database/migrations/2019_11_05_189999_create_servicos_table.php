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
            $table->decimal('pontuacao')->default(0.00);

            $table->decimal('comissao_atendimento')->default(0.00);
            $table->integer('tipo_comissao_atendimento')->unsigned();
            $table->decimal('comissao_equipe')->default(0.00);
            $table->integer('tipo_comissao_equipe')->unsigned();

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
		Schema::drop('servicos');
	}
}
