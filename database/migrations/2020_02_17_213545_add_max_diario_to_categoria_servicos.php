<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaxDiarioToCategoriaServicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categoria_servicos', function (Blueprint $table) {
          $table->integer('max_diario');
        });

        Schema::table('categoria_servicos', function (Blueprint $table) {
          $table->integer('max_diario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categoria_servicos', function (Blueprint $table) {
            //
        });
    }
}
