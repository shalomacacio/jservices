<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComissaoServicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comissao_servico', function (Blueprint $table) {

          $table->integer('comissao_id')->unsigned()->nullable();
          $table->foreign('comissao_id')->references('id')
                ->on('comissaos')->onDelete('cascade');

          $table->integer('servico_id')->unsigned()->nullable();
          $table->foreign('servico_id')->references('id')
                ->on('servicos')->onDelete('cascade');

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
        Schema::dropIfExists('comissao_servico');
    }
}
