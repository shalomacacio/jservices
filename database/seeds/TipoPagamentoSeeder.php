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

$tipoUsuario_create_permission =  Defender::createPermission('tipoUsuario.create', 'Criar tipoUsuario');
$tipoUsuario_update_permission =  Defender::createPermission('tipoUsuario.update', 'Alterar tipoUsuario');
$tipoUsuario_delete_permission =  Defender::createPermission('tipoUsuario.delete', 'Deletar tipoUsuario');
$tipoUsuario_list_permission =  Defender::createPermission('tipoUsuario.index',   'Listar tipoUsuario');
$tipoUsuario_show_permission =  Defender::createPermission('tipoUsuario.show',   'Visualizar tipoUsuario');
