<?php

namespace Database\Seeders;

use App\Models\TypeUser;
use Illuminate\Database\Seeder;

class TypeUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeUser::firstOrCreate([
            'description' => 'Comun'
        ]);

        TypeUser::firstOrCreate([
            'description' => 'Lojista'
        ]);
    }
}
