<?php

use Illuminate\Database\Seeder;
use App\Entities\TipoPagamento;

class TipoPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createTipoPagamento();
    }

    private function createTipoPagamento()
    {
      TipoPagamento::create([
        'descricao' => 'A VISTA',
      ]);

      TipoPagamento::create([
        'descricao' => 'DEBITO',
      ]);

      TipoPagamento::create([
        'descricao' => 'CREDITO',
      ]);

      TipoPagamento::create([
        'descricao' => 'BOLETO',
      ]);

      TipoPagamento::create([
        'descricao' => 'GRATUITO',
      ]);

    }
}

