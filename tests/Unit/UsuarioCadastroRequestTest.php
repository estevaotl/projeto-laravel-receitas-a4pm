<?php

namespace Tests\Unit;

use App\Http\Requests\UsuarioCadastroRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UsuarioCadastroRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_cadastro_valido()
    {
        $data = [
            'nome' => 'João da Silva',
            'login' => 'joaosilva' . uniqid(),
            'password' => 'senha123'
        ];

        $request = new UsuarioCadastroRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function test_cadastro_invalido()
    {
        $data = [
            'nome' => '',
            'login' => '',
            'password' => ''
        ];

        $request = new UsuarioCadastroRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('nome', $validator->errors()->toArray());
        $this->assertArrayHasKey('login', $validator->errors()->toArray());
        $this->assertArrayHasKey('password', $validator->errors()->toArray());
    }
}
