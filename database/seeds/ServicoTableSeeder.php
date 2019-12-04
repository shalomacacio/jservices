<?php

use Illuminate\Database\Seeder;
use App\Entities\Servico;

class ServicoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createServico();
    }

    private function createServico()
    {
      Servico::create([
        'categoria_servico_id'=> '1',
        'descricao' => 'PLANO 35 MEGA',
        'servico_vlr' => '69.99',
        'pontuacao' => '0.50' ,
        'comissao_atendimento' => '10.00',
        'tipo_comissao_atendimento' => '2',
        'comissao_equipe' => '8.00',
        'tipo_comissao_equipe' => '1',
      ]);

      Servico::create([
        'categoria_servico_id'=> '1',
        'descricao' => 'PLANO 50 MEGA',
        'servico_vlr' => '79.99',
        'pontuacao' => '0.50' ,
        'comissao_atendimento' => '10.00',
        'tipo_comissao_atendimento' => '2',
        'comissao_equipe' => '8.00',
        'tipo_comissao_equipe' => '1',
      ]);

      Servico::create([
        'categoria_servico_id'=> '1',
        'descricao' => 'PLANO 70 MEGA',
        'servico_vlr' => '89.99',
        'pontuacao' => '0.50' ,
        'comissao_atendimento' => '10.00',
        'tipo_comissao_atendimento' => '2',
        'comissao_equipe' => '8.00',
        'tipo_comissao_equipe' => '1',
      ]);

      Servico::create([
        'categoria_servico_id'=> '1',
        'descricao' => 'PLANO 100 MEGA',
        'servico_vlr' => '99.99',
        'pontuacao' => '0.50' ,
        'comissao_atendimento' => '10.00',
        'tipo_comissao_atendimento' => '2',
        'comissao_equipe' => '8.00',
        'tipo_comissao_equipe' => '1',
      ]);

      Servico::create([
        'categoria_servico_id'=> '1',
        'descricao' => 'PLANO 200 MEGA',
        'servico_vlr' => '150.00',
        'pontuacao' => '0.50' ,
        'comissao_atendimento' => '10.00',
        'tipo_comissao_atendimento' => '2',
        'comissao_equipe' => '8.00',
        'tipo_comissao_equipe' => '1',
      ]);
    }
}
