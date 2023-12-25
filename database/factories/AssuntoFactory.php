<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assunto>
 */
class AssuntoFactory extends Factory
{
    protected $options = [
        'Matemática',
        'Química',
        'Física',
        'Português',
        'Cálculo'
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'descricao' => fake()->randomElement($this->options) . fake()->numberBetween(1000,  9000),
        ];
    }
}
