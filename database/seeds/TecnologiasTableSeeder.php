<?php

use Illuminate\Database\Seeder;
use App\Entities\Tecnologia;

class TecnologiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createTecnologias();
    }

    private function createTecnologias()
    {
      Tecnologia::create([
        'descricao' => 'GPON',
      ]);

      Tecnologia::create([
        'descricao' => 'PACPON',
      ]);

      Tecnologia::create([
        'descricao' => 'RADIO',
      ]);
    }

}
