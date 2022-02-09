<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Cadastro de pessoas comuns
         */
        User::firstOrCreate([
            'email' => 'eliasjorgeramos@teste.com.br',
            'document' => '45374423100'
        ], [
            'name' => 'Elias Jorge Ramos',
            'password' => 'sywFhOiwmu',
            'type_id' => 1
        ]);

        User::firstOrCreate([
            'email' => 'aalanajulialaviniaoliveira@teste.com.br',
            'document' => '23604875315'
        ], [
            'name' => 'Alana Julia Lavínia Oliveira',
            'password' => 'sywFhOiwmu',
            'type_id' => 1
        ]);


        /**
         * Cadastro de pessoas lojistas
         */
        User::firstOrCreate([
            'email' => 'comunicacoes@mateuseveracontabilltda.com.br',
            'document' => '63244744000171'
        ], [
            'name' => 'Mateus e Vera Contábil Ltda',
            'password' => 'sywFhOiwmu',
            'type_id' => 2
        ]);

        User::firstOrCreate([
            'email' => 'juridico@clariceenataliacomerciodebebidasme.com.br',
            'document' => '31656955000125'
        ], [
            'name' => 'Clarice e Natália Comercio de Bebidas ME',
            'password' => 'sywFhOiwmu',
            'type_id' => 2
        ]);
    }
}
