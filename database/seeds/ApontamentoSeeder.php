<?php

use App\Apontamento;
use App\User;
use Illuminate\Database\Seeder;

class ApontamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1;$i<=100;$i++) {
            $apont = new Apontamento();
            $apont->codigo = "000123456".random_int(1,100);
            if (($i%2)==0) {
                $apont->user_id = User::first()->id;
            } else {
                $apont->user_id = User::all()[random_int(1,2)]->id;
            }
            $apont->save();
        }
    }
}
