<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePesquisaSatisfacaosTable.
 */
class CreatePesquisaSatisfacaosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pesquisa_satisfacaos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('cliente_id');

            $table->integer('qtd_usuarios')->nullable();
            $table->integer('provedor_id')->nullable();
            $table->string('nome_provedor')->nullable();
            $table->string('plano')->nullable();
            $table->decimal('vlr_plano')->nullable();
            $table->date('dt_venc_contrato')->nullable();

            $table->tinyInteger('jogo')->nullable();
            $table->tinyInteger('filme')->nullable();

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
		Schema::drop('pesquisa_satisfacaos');
	}
}
