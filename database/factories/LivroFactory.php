<?php

namespace Database\Factories;

use App\Models\Assunto;
use App\Models\Autor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livro>
 */
class LivroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titulo' => fake()->company(),
            'editora' => substr('Editora ' . fake()->jobTitle(), 0, 40),
            'edicao'  => fake()->randomDigitNotNull(),
            'anopublicacao' => fake()->year(),
            'valor' => fake()->numberBetween(20, 100),
            // 'autores' => Autor::inrandomorder()->limit(2)->get()->pluck('codau')->toArray(),
            // 'assuntos' => [Assunto::inrandomorder()->first()->codas],
        ];
    }
}
