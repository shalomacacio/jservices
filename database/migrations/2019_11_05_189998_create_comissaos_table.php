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
            $table->date('dt_referencia');
            $table->integer('funcionario_id');
            $table->integer('solicitacao_id');

            // $table->integer('servico_id');
            // $table->decimal('servico_vlr');
            // $table->decimal('servico_comissao');
            // $table->integer('servico_tipo_comissao_id');

            $table->decimal('comissao_vlr')->default(0.00);
            $table->tinyInteger('flg_autorizado')->default(3);
            $table->text('motivo')->nullable();
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
