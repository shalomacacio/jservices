<?php

use Illuminate\Database\Seeder;
use App\Entities\TipoAquisicao;

class TipoAquisicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createTipoAquisicao();
    }

    private function createTipoAquisicao()
    {
      TipoAquisicao::create([
        'descricao' => 'VENDA',
      ]);

      TipoAquisicao::create([
        'descricao' => 'COMODATO',
      ]);

    }
}
