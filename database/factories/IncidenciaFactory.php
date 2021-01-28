<?php

namespace Database\Factories;

use App\Models\Incidencia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class IncidenciaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Incidencia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'latitud' => $this->faker->latitude,
            'longitud' => $this->faker->longitude,
            'ciudad' => $this->faker->city,
            'direccion' => $this->faker->streetAddress,
            'etiqueta' => Str::random(3),
            'descripcion' => $this->faker->text($maxNbChars = 200),
            'estado' => 'abierta',
            'nivel' => 1
        ];
    }
}
