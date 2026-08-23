<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Contraseña utilizada por la fábrica.
     */
    protected static ?string $password;

    /**
     * Define los datos predeterminados del usuario.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role_id' => function () {

                $roleId = DB::table('roles')

                    ->where('nombre', 'Tecnico')

                    ->value('id');

                if ($roleId) {

                    return $roleId;

                }

                return DB::table('roles')->insertGetId([
                    'nombre' => 'Tecnico',
                    'descripcion' =>
                        'Gestiona equipos y mantenimientos',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            },

            'name' => fake()->name(),

            'email' => fake()
                ->unique()
                ->safeEmail(),

            'email_verified_at' => now(),

            'password' => static::$password
                ??= Hash::make('password'),

            'activo' => true,

            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indica que el correo no está verificado.
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {

            return [
                'email_verified_at' => null,
            ];

        });
    }
}