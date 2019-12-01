<?php

use Illuminate\Database\Seeder;
use App\Entities\CategoriaServico;
use Illuminate\Support\Facades\DB;

class CategoriaServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->createCategoriaServicos();
    }

    private function createCategoriaServicos()
    {
      CategoriaServico::create([
        'descricao' => 'ADESÃO',
      ]);
      // Exibe uma informação no console durante o processo de seed
      $this->command->info('Categoria ADESÃO criada');

      CategoriaServico::create([
        'descricao' => 'CANCELAMENTO',
      ]);
      // Exibe uma informação no console durante o processo de seed
      $this->command->info('Categoria CANCELAMENTO criada');

      CategoriaServico::create([
        'descricao' => 'FIAÇÃO EXTERNA',
      ]);
      // Exibe uma informação no console durante o processo de seed
      $this->command->info('Categoria FIAÇÃO EXTERNA criada');

      CategoriaServico::create([
        'descricao' => 'MIGRAÇÃO',
      ]);
      // Exibe uma informação no console durante o processo de seed
      $this->command->info('Categoria MIGRAÇÃO criada');

      CategoriaServico::create([
        'descricao' => 'REATIVAÇÃO',
      ]);
      // Exibe uma informação no console durante o processo de seed
      $this->command->info('Categoria REATIVAÇÃO criada');

      CategoriaServico::create([
        'descricao' => 'SERV PAGO',
      ]);
      // Exibe uma informação no console durante o processo de seed
      $this->command->info('Categoria SERV PAGO criada');

      CategoriaServico::create([
        'descricao' => 'SERV GRATUITO',
      ]);
      // Exibe uma informação no console durante o processo de seed
      $this->command->info('Categoria SERV GRATUIRO criada');

      CategoriaServico::create([
        'descricao' => 'TRANSFERENCIA',
      ]);
      // Exibe uma informação no console durante o processo de seed
      $this->command->info('Categoria TRANSFERENCIA criada');

      CategoriaServico::create([
        'descricao' => 'UPGRADE',
      ]);
      // Exibe uma informação no console durante o processo de seed
      $this->command->info('Categoria UPGRADE criada');
    }
}
