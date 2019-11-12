<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitacaoTecnicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacao_tecnico', function (Blueprint $table) {
            $table->integer('solicitacao_id')->unsigned()->nullable();
            $table->foreign('solicitacao_id')->references('id')
                  ->on('solicitacaos')->onDelete('cascade');

            $table->integer('tecnico_id')->unsigned()->nullable();
            $table->foreign('tecnico_id')->references('id')
                  ->on('tecnicos')->onDelete('cascade');

            $table->decimal('comissao_tecnico')->nullable();

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
        Schema::dropIfExists('solicitacao_tecnico');
    }
}
