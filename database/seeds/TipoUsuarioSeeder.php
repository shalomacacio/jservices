<?php

use Illuminate\Database\Seeder;
use App\Entities\Solicitacao;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $solicitacoes = factory(App\Entities\Solicitacao::class, 60)->create();
    }


}
