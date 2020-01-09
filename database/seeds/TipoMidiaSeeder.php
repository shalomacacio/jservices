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
        'descricao' => 'VENDA EXTERNA',
      ]);

      TipoMidia::create([
        'descricao' => 'INDICAÇAO',
      ]);

      TipoMidia::create([
        'descricao' => 'INSTAGRAM',
      ]);

      TipoMidia::create([
        'descricao' => 'FACEBOOK',
      ]);

      TipoMidia::create([
        'descricao' => 'PANFLETO',
      ]);

      TipoMidia::create([
        'descricao' => 'BANNER',
      ]);

      TipoMidia::create([
        'descricao' => 'STATUS WHATS',
      ]);

      TipoMidia::create([
        'descricao' => 'VENDA ATIVA',
      ]);

      TipoMidia::create([
        'descricao' => 'TECNICO NA RUA',
      ]);

      TipoMidia::create([
        'descricao' => 'OUTRO PONTO',
      ]);

      TipoMidia::create([
        'descricao' => 'PESQUISA WEB',
      ]);

    }
}
