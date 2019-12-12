<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscalaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escala_user', function (Blueprint $table) {

          $table->integer('escala_id')->unsigned();
          $table->foreign('escala_id')->references('id')
                ->on('escalas');

          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')
                ->on('users');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escala_user');
    }
}
