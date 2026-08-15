<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposIntervencionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipos_intervencion')->insert([

            [
                'nombre' => 'Cambio de baterías',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Cambio de módulo de baterías',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Cambio de módulo de potencia',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Cambio de display',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Cambio de tarjeta de comunicación',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Instalación de tarjeta de comunicación',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Cambio de ventilador',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Cambio de otro componente',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}