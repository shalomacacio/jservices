<?php

use Illuminate\Database\Seeder;
use App\Entities\StatusSolicitacao;

class StatusSolicitacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createStatusSolicitacao();
    }

    private function createStatusSolicitacao()
    {
      StatusSolicitacao::create([
        'descricao' => 'aberto',
      ]);

      StatusSolicitacao::create([
        'descricao' => 'encaminhado',
      ]);

      StatusSolicitacao::create([
        'descricao' => 'concluido',
      ]);

      StatusSolicitacao::create([
        'descricao' => 'cancelado',
      ]);

      StatusSolicitacao::create([
        'descricao' => 'pendente',
      ]);

    }
}
