<?php

use Illuminate\Database\Seeder;
use App\Entities\TipoMidia;

class TipoMidiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createTipoMidia();
    }

    private function createTipoMidia()
    {
      TipoMidia::create([
        'descricao' => 'INDICAÇÃO',
      ]);

      TipoMidia::create([
        'descricao' => 'PANFLETO',
      ]);

      TipoMidia::create([
        'descricao' => 'RADIO',
      ]);

      TipoMidia::create([
        'descricao' => 'PROP VOLANTE',
      ]);

      TipoMidia::create([
        'descricao' => 'REDES SOCIAIS',
      ]);


    }
}
