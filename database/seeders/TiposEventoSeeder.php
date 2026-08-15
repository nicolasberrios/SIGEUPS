<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposEventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipos_evento')->insert([

            [
                'nombre' => 'Recepción',
                'categoria' => 'Ingreso',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Diagnóstico',
                'categoria' => 'Servicio',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Mantenimiento preventivo',
                'categoria' => 'Servicio',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Reparación',
                'categoria' => 'Servicio',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Préstamo',
                'categoria' => 'Logística',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Devolución',
                'categoria' => 'Logística',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Cambio de ubicación',
                'categoria' => 'Logística',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Inspección',
                'categoria' => 'Servicio',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}