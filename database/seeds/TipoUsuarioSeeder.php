<?php

use Illuminate\Database\Seeder;
use App\Entities\TipoUsuario;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->createTipoUsuarios();
    }

    private function createTipoUsuarios()
    {
      TipoUsuario::create([
        'descricao' => 'ADMINISTRADOR',
      ]);

      TipoUsuario::create([
        'descricao' => 'ATENDIMENTO',
      ]);

      TipoUsuario::create([
        'descricao' => 'TÉCNICO',
      ]);

      TipoUsuario::create([
        'descricao' => 'FINANCEIRO',
      ]);

      TipoUsuario::create([
        'descricao' => 'SUPERVISOR',
      ]);

      TipoUsuario::create([
        'descricao' => 'VENDEDOR',
      ]);
    }
}
