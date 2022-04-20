<?php

namespace Database\Factories;

use App\Models\Jornada;
use Illuminate\Database\Eloquent\Factories\Factory;

class JornadaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jornada::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return[
            'nombre' => $this->faker->name,
            'fecha' => $this->faker->date,
            'localidad' => 'Queretaro',
            'municipio' => 'Queretaro',
        ];
    }
}
