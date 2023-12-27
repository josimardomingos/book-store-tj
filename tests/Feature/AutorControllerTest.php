<?php

namespace Tests\Feature;

use App\Models\Autor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AutorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_pode_listar_todos_os_autores()
    {
        Autor::factory(3)->create();

        $response = $this->getJson('/api/autores');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_pode_obter_detalhes_de_um_autor()
    {
        $autor = Autor::factory()->create();

        $response = $this->getJson("/api/autores/{$autor->codau}");

        $response->assertStatus(200)
            ->assertJson(['data' => ['codau' => $autor->codau]]);
    }

    public function test_pode_criar_um_autor()
    {
        $autorData = [
            'nome' => 'Novo Autor',
        ];

        $response = $this->postJson('/api/autores', $autorData);

        $response->assertStatus(201)
            ->assertJsonFragment(['nome' => 'Novo Autor']);

        $this->assertDatabaseHas('autor', $autorData);
    }

    public function test_pode_atualizar_um_autor()
    {
        $autor = Autor::factory()->create();
        $novoNome = 'Novo Nome';

        $response = $this->putJson("/api/autores/{$autor->codau}", ['nome' => $novoNome]);

        $response->assertStatus(200)
            ->assertJsonFragment(['nome' => $novoNome]);
    }

    public function test_pode_excluir_um_autor()
    {
        $autor = Autor::factory()->create();

        $response = $this->deleteJson("/api/autores/{$autor->codau}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('autor', ['codau' => $autor->codau]);
    }
}
