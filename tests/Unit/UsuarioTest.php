<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticavel()
    {
        $usuario = Usuario::factory()->create([
            'login' => 'joao',
            'senha' => Hash::make('senha123'),
        ]);

        $this->assertDatabaseHas('usuarios', ['login' => 'joao']);
    }
}
