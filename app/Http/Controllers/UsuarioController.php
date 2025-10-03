<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Carbon\Carbon;

class UsuarioController extends Controller
{
    public function autenticar(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $usuario = Usuario::where('login', $request->login)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->senha)) {
            return back()->withErrors([
                'login' => 'Credenciais inválidas.',
            ]);
        }

        Auth::login($usuario);

        return redirect()->route('dashboard');
    }

    public function registrar(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|min:2|max:100',
            'login' => 'required|string|unique:usuarios,login|min:2|max:100',
            'password' => 'required|string|min:2|max:100',
        ]);

        $usuario = Usuario::create([
            'nome' => $request->nome,
            'login' => $request->login,
            'senha' => Hash::make($request->password),
            'criado_em' => Carbon::now(),
            'alterado_em' => Carbon::now(),
        ]);

        Auth::login($usuario);

        return redirect()->route('dashboard');
    }
}
