<?php

namespace Database\Seeders;

use App\Models\StatusTransaction;
use Illuminate\Database\Seeder;

class StatusTransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusTransaction::firstOrCreate([
            'description' => 'Pendente'
        ]);

        StatusTransaction::firstOrCreate([
            'description' => 'Processando'
        ]);

        StatusTransaction::firstOrCreate([
            'description' => 'Autorizado'
        ]);

        StatusTransaction::firstOrCreate([
            'description' => 'Em disputa'
        ]);

        StatusTransaction::firstOrCreate([
            'description' => 'Devolvido'
        ]);

        StatusTransaction::firstOrCreate([
            'description' => 'Recusado'
        ]);
    }
}
