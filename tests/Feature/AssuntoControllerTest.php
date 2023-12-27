<?php

namespace Tests\Feature;

use App\Models\Assunto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AssuntoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_pode_listar_todos_os_assuntos()
    {
        Assunto::factory(3)->create();

        $response = $this->getJson('/api/assuntos');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_pode_obter_detalhes_de_um_assunto()
    {
        $assunto = Assunto::factory()->create();

        $response = $this->getJson("/api/assuntos/{$assunto->codas}");

        $response->assertStatus(200)
            ->assertJson(['data' => ['codas' => $assunto->codas]]);
    }

    public function test_pode_criar_um_assunto()
    {
        $assuntoData = [
            'descricao' => 'Novo Assunto',
        ];

        $response = $this->postJson('/api/assuntos', $assuntoData);

        $response->assertStatus(201)
            ->assertJsonFragment(['descricao' => 'Novo Assunto']);

        $this->assertDatabaseHas('assunto', $assuntoData);
    }

    public function test_pode_atualizar_um_assunto()
    {
        $assunto = Assunto::factory()->create();
        $novoNome = 'Novo Assunto';

        $response = $this->putJson("/api/assuntos/{$assunto->codas}", ['descricao' => $novoNome]);

        $response->assertStatus(200)
            ->assertJsonFragment(['descricao' => $novoNome]);
    }

    public function test_pode_excluir_um_assunto()
    {
        $assunto = Assunto::factory()->create();

        $response = $this->deleteJson("/api/assuntos/{$assunto->codas}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('assunto', ['codas' => $assunto->codas]);
    }
}
