<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estados')->insert([
            ['nombre' => 'Disponible',         'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'En uso',             'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'En mantenimiento',   'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Fuera de servicio',  'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}