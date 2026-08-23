<?php

namespace Database\Seeders;

use App\Models\TipoEvento;
use Illuminate\Database\Seeder;

class TiposEventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [

            ['nombre' => 'Registro de UPS',          'categoria' => 'Administrativo'],
            ['nombre' => 'Actualización de UPS',     'categoria' => 'Administrativo'],
            ['nombre' => 'Cambio de estado',         'categoria' => 'Administrativo'],

            ['nombre' => 'Recepción',                'categoria' => 'Ingreso'],
            ['nombre' => 'Diagnóstico',              'categoria' => 'Servicio'],
            ['nombre' => 'Mantenimiento preventivo', 'categoria' => 'Servicio'],
            ['nombre' => 'Reparación',               'categoria' => 'Servicio'],
            ['nombre' => 'Inspección',               'categoria' => 'Servicio'],

            ['nombre' => 'Préstamo',                 'categoria' => 'Logística'],
            ['nombre' => 'Devolución',               'categoria' => 'Logística'],
            ['nombre' => 'Cambio de ubicación',      'categoria' => 'Logística'],

        ];

        foreach ($tipos as $tipo) {

            TipoEvento::firstOrCreate(

                ['nombre' => $tipo['nombre']],

                [
                    'categoria' => $tipo['categoria'],
                ]

            );

        }
    }
}