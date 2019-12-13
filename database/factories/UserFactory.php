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
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => '123456',
    ];
});


$factory->define(App\Entities\Solicitacao::class, function (Faker $faker) {
  return [
      'cod_cliente' => $faker->randomDigit(2,0,9999),
      'cliente' => $faker->name,
      'user_id' => App\Entities\User::all()->random()->id,
      'servico_id' => App\Entities\Servico::all()->random()->id,
      // 'servico_' => $faker->randomFloat(2, 1, 200 ),
      'tecnologia_id' => App\Entities\Tecnologia::all()->random()->id,
      'status_solicitacao_id' => 1,
      'dt_agendamento' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+20 days', $timezone = null),
      'tipo_pagamento_id' => App\Entities\TipoPagamento::all()->random()->id,
      'tipo_midia_id' => App\Entities\TipoMidia::all()->random()->id,
      'tipo_aquisicao_id' => App\Entities\TipoAquisicao::all()->random()->id,

  ];
});
