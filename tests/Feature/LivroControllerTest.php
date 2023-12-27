<?php

namespace Tests\Feature;

use App\Models\Livro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LivroControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function test_pode_listar_todos_os_livros()
    {
        Livro::factory(3)->create();

        $response = $this->getJson('/api/livros');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_pode_obter_detalhes_de_um_livro()
    {
        $livro = Livro::factory()->create();

        $response = $this->getJson("/api/livros/{$livro->codl}");

        $response->assertStatus(200)
            ->assertJson(['data' => ['codl' => $livro->codl]]);
    }

    public function test_pode_criar_um_livro()
    {
        $livroData = [
            'titulo' => 'Livro de Teste',
            'editora' => 'Editora de tese',
            'edicao' => 2,
            'anopublicacao' => '2023',
            'valor' => 50,
        ];

        $response = $this->postJson('/api/livros', $livroData);

        $response->assertStatus(201)
            ->assertJsonFragment($livroData);

        $this->assertDatabaseHas('livro', $livroData);
    }

    public function test_pode_atualizar_um_livro()
    {
        $livro = Livro::factory()->create();
        $novoTitulo = 'Novo Título';

        $response = $this->putJson("/api/livros/{$livro->codl}", ['titulo' => $novoTitulo]);

        $response->assertStatus(200)
            ->assertJsonFragment(['titulo' => $novoTitulo]);
    }

    public function test_pode_excluir_um_livro()
    {
        $livro = Livro::factory()->create();

        $response = $this->deleteJson("/api/livros/{$livro->codl}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('livro', ['codl' => $livro->codl]);
    }
}
