<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Entities\User::class, function (Faker $faker) {
    return [
        'name' => 'Administrador',
        'email' => 'admin@jnetce.com.br',
        'password' => '@jnet7168',
        'tipo_usuario_id' => 1,
    ];
});
