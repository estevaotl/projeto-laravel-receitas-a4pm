<?php

namespace Tests\Unit;

use App\Http\Requests\UsuarioLoginRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UsuarioLoginRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_request_valido()
    {
        $data = ['login' => 'joao', 'password' => 'senha123'];
        $request = new UsuarioLoginRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function test_login_request_invalido()
    {
        $data = ['login' => '', 'password' => ''];
        $request = new UsuarioLoginRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('login', $validator->errors()->toArray());
        $this->assertArrayHasKey('password', $validator->errors()->toArray());
    }
}
