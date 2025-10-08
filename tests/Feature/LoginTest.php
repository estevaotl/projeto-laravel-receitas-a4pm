<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_pode_autenticar()
    {
        $login = 'joao_' . uniqid();

        $usuario = Usuario::factory()->create([
            'login' => $login,
            'senha' => Hash::make('senha123'),
        ]);

        $response = $this->post('/login', [
            'login' => $login,
            'password' => 'senha123',
        ]);

        $response->assertRedirect(route('receitas.dashboard'));
        $this->assertAuthenticatedAs($usuario);
    }

    public function test_usuario_com_credenciais_invalidas()
    {
        $response = $this->post('/login', [
            'login' => 'joao' . uniqid(),
            'password' => 'errado',
        ]);

        $response->assertSessionHasErrors('login');
        $this->assertGuest();
    }
}
