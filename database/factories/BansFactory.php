<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bans>
 */
class BansFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "id_servidor" => fake()->numberBetween(1,20),
        "steam_id" => fake()->uuid(),
        "nombre" => fake()->name(),
        "razon" => fake()->text(),
            "tiempo_inicio" => fake()->numberBetween(1708640478,1708642478),
            "tiempo_final" => fake()->numberBetween(1708643478,1708644478),
        "nombre_moderador" => fake()->name(),
        ];
    }
}
