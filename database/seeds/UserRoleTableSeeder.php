<?php

use Illuminate\Database\Seeder;
use Artesaos\Defender\Facades\Defender;
use App\Entities\User;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->createUserRole();
    }

    private function createUserRole()
    {
      $roleAdmin = Defender::createRole('admin');
      $user = User::find(1);
      $user->attachRole($roleAdmin);

      $roleAtendimento = Defender::createRole('atendimento');
      $roleSupervisor = Defender::createRole('supervisor');
      $roleAuditor = Defender::createRole('auditor');
      $roleSuporte = Defender::createRole('suporte');
      $roleControlador = Defender::createRole('controlador');

      $usersSuporte = User::find([2,3,4,5]);
      foreach($usersSuporte as $user){
        $user->attachRole($roleSuporte);
      }

    }
}
