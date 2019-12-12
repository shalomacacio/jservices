<?php

use Illuminate\Database\Seeder;
use App\Entities\User;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // DB::table('users')->truncate();
      $this->createUser();
    }

    private function createUser()
    {
      User::create([
        'name' => 'Administrador',
        'email' => 'admin@jnetce.com.br',
        'password' => '@jnet7168',
      ]);
      // Exibe uma informação no console durante o processo de seed
      $this->command->info('usuario Administrador criado');

      User::create([
        'name' => 'HARISSON',
        'sobrenome' => 'CRISTIAN',
        'email' => 'harisson@jnetce.com.br',
        'password' => '123456',
      ]);

      User::create([
        'name' => 'LUIZ',
        'sobrenome' => 'HENRIQUE',
        'email' => 'luizhenrique@jnetce.com.br',
        'password' => '123456',
      ]);

      User::create([
        'name' => 'RENAN',
        'sobrenome' => 'SANTOS',
        'email' => 'renansantos@jnet.ce.com.br',
        'password' => '123456',
      ]);

      User::create([
        'name' => 'RENAN',
        'sobrenome' => 'SILVA',
        'email' => 'renansilva@jnetce.com.br',
        'password' => '123456',
      ]);
    }
}






