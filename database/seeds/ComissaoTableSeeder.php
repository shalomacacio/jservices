<?php

use Illuminate\Database\Seeder;
use App\Entities\Comissao;
use Illuminate\Support\Facades\DB;

class ComissaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->createComissao();
    }

    private function createComissao()
    {
      Comissao::create([
        'descricao' => 'Adesao Interna',
        'valor' => '10',
        'tipo_comissao_id' => '1',
      ]);

      Comissao::create([
        'descricao' => 'Adesao Externa',
        'valor' => '8.00',
        'tipo_comissao_id' => '1',
      ]);

      Comissao::create([
        'descricao' => 'Adesao Tecnico',
        'valor' => '8.00',
        'tipo_comissao_id' => '2',
      ]);
    }
}
