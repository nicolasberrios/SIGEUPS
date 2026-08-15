<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            EstadosSeeder::class,
            UbicacionesSeeder::class,
            MarcasSeeder::class,
            PropietariosSeeder::class,
            TiposEventoSeeder::class,
            TiposIntervencionSeeder::class,
            ModelosSeeder::class,
            AdminSeeder::class,
        ]);
    }
}