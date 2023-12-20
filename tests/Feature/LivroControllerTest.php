<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LivroControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function test_pode_criar_um_livro()
    {
        $livroData = [
            'titulo' => 'Livro de Teste',
            'editora' => 'Editora de tese',
            'edicao' => 2,
            'anopublicacao' => '2023',
        ];

        $response = $this->postJson('/api/livros', $livroData);

        $response->assertStatus(201)
            ->assertJsonFragment($livroData);

        $this->assertDatabaseHas('livro', $livroData);
    }
}
