<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable.
 */
class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('sobrenome', 50)->nullable();

            //campos de autenticação
            $table->string('email', 80)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 254);

            // $table->integer('tipo_usuario_id')->unsigned()->nullable();
            // $table->foreign('tipo_usuario_id')->references('id')->on('tipo_usuarios');

            //campos padrao
            $table->rememberToken();
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
		Schema::drop('users');
	}
}
