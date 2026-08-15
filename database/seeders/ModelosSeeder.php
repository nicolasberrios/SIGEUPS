<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelosSeeder extends Seeder
{
    public function run(): void
    {
        $modelos = [

            // APC
            ['marca_id' => 1, 'nombre' => 'Smart-UPS SRT 3000'],
            ['marca_id' => 1, 'nombre' => 'Smart-UPS SRT 6000'],

            // Eaton
            ['marca_id' => 2, 'nombre' => '9PX 3000'],
            ['marca_id' => 2, 'nombre' => '9PX 6000'],

            // Vertiv
            ['marca_id' => 3, 'nombre' => 'GXT5-3000'],
            ['marca_id' => 3, 'nombre' => 'GXT5-6000'],

            // Delta
            ['marca_id' => 9, 'nombre' => 'RT 3kVA'],

            // Forza
            ['marca_id' => 5, 'nombre' => 'Atlas 3000'],
        ];

        foreach ($modelos as $modelo) {

            DB::table('modelos')->insert([
                'marca_id' => $modelo['marca_id'],
                'nombre' => $modelo['nombre'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
    }
}