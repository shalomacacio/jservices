<?php

use Illuminate\Database\Seeder;

class PlanoSeeder extends Seeder
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

    private function createCategoriaServicos()
    {
      CategoriaServico::create([
        'descricao' => 'ADESÃO',
      ]);
      // Exibe uma informação no console durante o processo de seed
      $this->command->info('Categoria ADESÃO criada');
    }
}
