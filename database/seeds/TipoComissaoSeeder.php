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
        $this->createTipoComissao();
    }


    private function createTipoComissao()
    {

      TipoComissao::create([
        'descricao' => 'R$',
      ]);

      TipoComissao::create([
        'descricao' => '%',
      ]);


    }
}
