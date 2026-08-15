<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropietariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('propietarios')->insert([

            [
                'nombre' => 'Powertec',
                'sucursal' => 'Casa Matriz',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Hospital Regional',
                'sucursal' => 'Concepción',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Banco Estado',
                'sucursal' => 'Centro',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Universidad de Concepción',
                'sucursal' => 'Campus Central',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Empresa Demo',
                'sucursal' => 'Sucursal Principal',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}