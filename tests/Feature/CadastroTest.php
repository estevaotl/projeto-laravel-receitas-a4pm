<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CadastroTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_pode_se_cadastrar()
    {
        $login = 'joaosilva_' . uniqid();

        $response = $this->post('/cadastro', [
            'nome' => 'João da Silva',
            'login' => $login,
            'password' => 'senha123'
        ]);

        $response->assertRedirect(route('receitas.dashboard'));

        $this->assertDatabaseHas('usuarios', [
            'login' => $login
        ]);
    }

    public function test_cadastro_com_login_duplicado()
    {
        $login = 'joaosilva_' . uniqid();

        Usuario::factory()->create(['login' => $login]);

        $response = $this->post('/cadastro', [
            'nome' => 'Outro João',
            'login' => $login,
            'password' => 'senha456'
        ]);

        $response->assertSessionHasErrors('login');
    }
}
