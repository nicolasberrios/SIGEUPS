<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ubicaciones')->insert([
            [
                'nombre' => 'Laboratorio',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Bodega',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Instalada en cliente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}