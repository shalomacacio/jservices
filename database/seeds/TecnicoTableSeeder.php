<?php

use Illuminate\Database\Seeder;
use App\Entities\Tecnico;

class TecnicoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createTecnico();
    }

    private function createTecnico()
    {
      Tecnico::create([
        'nome' => 'RENAN',
        'sobrenome' => 'SILVA',
        'email' => 'renansilva@jnetce.com.br',
        'telefone' => '5585987961850',
      ]);

      Tecnico::create([
        'nome' => 'HARISSON',
        'sobrenome' => 'CRISTIAN',
        'email' => 'harisson@jnetce.com.br',
        'telefone' => '5585985196633',
      ]);

      Tecnico::create([
        'nome' => 'LUIZ',
        'sobrenome' => 'HENRIQUE',
        'email' => 'luizhenrique@jnetce.com.br',
        'telefone' => '5585986932091',
      ]);

      Tecnico::create([
        'nome' => 'RENAN',
        'sobrenome' => 'SANTOS',
        'email' => 'renansantos@jnet.ce.com.br',
        'telefone' => '5585989689219',
      ]);
    }
}
