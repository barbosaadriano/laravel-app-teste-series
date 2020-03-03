<?php

use App\Empresa;
use App\User;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = User::all();
        foreach($users as $u){
            Empresa::create(["nome"=>"Empresa do {$u->name} ","user_id"=>$u->id]);
        }

    }
}
