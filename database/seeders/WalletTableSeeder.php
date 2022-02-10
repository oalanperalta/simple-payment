<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wallet::firstOrCreate([
            'user_id' => 1
        ], [
            'value' => 123.50
        ]);

        Wallet::firstOrCreate([
            'user_id' => 2
        ], [
            'value' => 500
        ]);

        Wallet::firstOrCreate([
            'user_id' => 3
        ], [
            'value' => 5000.98
        ]);

        Wallet::firstOrCreate([
            'user_id' => 4
        ], [
            'value' => 12300.00
        ]);
    }
}
