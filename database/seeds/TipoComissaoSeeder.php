<?php

use Illuminate\Database\Seeder;
use App\Entities\TipoComissao;

class TipoComissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }


    private function createTipoComissao()
    {
      TipoComissao::create([
        'descricao' => 'Percentual',
      ]);

      TipoComissao::create([
        'descricao' => 'Valor Fixo',
      ]);
    }
}
