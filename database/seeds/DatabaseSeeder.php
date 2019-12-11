<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
        TipoUsuarioSeeder::class,
        UsersTableSeeder::class,
        CategoriaServicoSeeder::class,
        StatusSolicitacaoSeeder::class,
        TecnologiasTableSeeder::class,
        TipoAquisicaoSeeder::class,
        TipoComissaoSeeder::class,
        TipoMidiaSeeder::class,
        TipoPagamentoSeeder::class,
        TecnicoTableSeeder::class,
        UserRoleTableSeeder::class,
        ServicoTableSeeder::class,
        PermissionTableSeeder::class,
      ]);

    }
}
