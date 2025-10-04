<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioCadastroRequest;
use App\Http\Requests\UsuarioLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Carbon\Carbon;

class UsuarioController extends Controller
{
    public function autenticar(UsuarioLoginRequest $request)
    {
        $usuario = Usuario::where('login', $request->login)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->senha)) {
            return back()->withErrors([
                'login' => 'Credenciais inválidas.',
            ]);
        }

        Auth::login($usuario);

        return redirect()->route('receitas.dashboard');
    }

    public function registrar(UsuarioCadastroRequest $request)
    {
        $usuario = Usuario::create([
            'nome' => $request->nome,
            'login' => $request->login,
            'senha' => Hash::make($request->password),
            'criado_em' => Carbon::now(),
            'alterado_em' => Carbon::now(),
        ]);

        Auth::login($usuario);

        return redirect()->route('receitas.dashboard');
    }
}
