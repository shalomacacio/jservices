<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitacaosTecnicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacaos_tecnicos', function (Blueprint $table) {
            $table->integer('solicitacao_id')->unsigned()->nullable();
            $table->foreign('solicitacao_id')->references('id')
                  ->on('solicitacaos')->onDelete('cascade');

            $table->integer('tecnico_id')->unsigned()->nullable();
            $table->foreign('tecnico_id')->references('id')
                  ->on('tecnicos')->onDelete('cascade');

            $table->decimal('comissao_tecnico');

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
        Schema::dropIfExists('solicitacaos_tecnicos');
    }
}
