<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('marcas')->insert([
            ['nombre' => 'APC', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Eaton', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Vertiv', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Tripp Lite', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Forza', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'CDP', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Liebert', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Emerson', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Delta', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Otro', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}