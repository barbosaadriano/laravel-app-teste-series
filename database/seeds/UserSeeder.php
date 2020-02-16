<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Adriano Barbosa',
            'email' => 'b.adrianobarbosa@gmail.com',
            'password' => Hash::make("123456789"),
        ]);
        User::create([
            'name'=>'Fernanda Boeing',
            'email' => 'boeingfernanda@gmail.com',
            'password' => Hash::make("123456789"),
        ]);
        User::create([
            'name'=>'Master',
            'email' => 'adriano@adrianob.com.br',
            'password' => Hash::make("master"),
        ]);
    }
}
