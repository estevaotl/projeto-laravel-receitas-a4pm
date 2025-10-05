<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioCadastroRequest;
use App\Http\Requests\UsuarioLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Carbon\Carbon;

/**
 * @OA\Tag(
 *     name="Usuários",
 *     description="Operações de autenticação e cadastro de usuários"
 * )
 */
class UsuarioController extends Controller
{
    /**
     * @OA\Post(
     *     path="/login",
     *     summary="Autentica um usuário",
     *     tags={"Usuários"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"login", "password"},
     *             @OA\Property(property="login", type="string", example="usuario123"),
     *             @OA\Property(property="password", type="string", example="senha123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=302,
     *         description="Redireciona para o dashboard após login"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Credenciais inválidas"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erros de validação",
     *            @OA\JsonContent(
     *              @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="login", type="array",
     *                     @OA\Items(type="string", example="['O campo login é obrigatório.', 'O login deve ter no mínimo 2 caracteres.', 'O login deve ter no máximo 100 caracteres.']")
     *                 ),
     *                 @OA\Property(property="password", type="array",
     *                     @OA\Items(type="string", example="['O campo senha é obrigatório.', 'A senha deve deve ter no mínimo 2 caracteres.', 'A senha deve ter no máximo 100 caracteres.']")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function autenticar(UsuarioLoginRequest $request)
    {
        $usuario = Usuario::where('login', $request->login)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->senha)) {
            return back()->withErrors([
                'login' => 'Credenciais inválidas.'
            ]);
        }

        Auth::login($usuario);

        return redirect()->route('receitas.dashboard');
    }

    /**
     * @OA\Post(
     *     path="/cadastro",
     *     summary="Registra um novo usuário",
     *     tags={"Usuários"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome", "login", "password"},
     *             @OA\Property(property="nome", type="string", example="João da Silva"),
     *             @OA\Property(property="login", type="string", example="joaosilva"),
     *             @OA\Property(property="password", type="string", example="senhaSegura123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=302,
     *         description="Redireciona para o dashboard após cadastro com sucesso"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erros de validação",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="login", type="array",
     *                      @OA\Items(type="string", example="['O campo login é obrigatório.', 'O login deve ter no mínimo 2 caracteres.', 'O login deve ter no máximo 100 caracteres.', 'O login deve ser único, ou seja, não deve existir outro usuario com o mesmo login escolhido.']")
     *                 ),
     *                 @OA\Property(property="password", type="array",
     *                      @OA\Items(type="string", example="['O campo senha é obrigatório.', 'A senha deve deve ter no mínimo 2 caracteres.', 'A senha deve ter no máximo 100 caracteres.']")
     *                 ),
     *                 @OA\Property(property="nome", type="array",
     *                      @OA\Items(type="string", example="['O campo nome é obrigatório.', 'O nome deve deve ter no mínimo 2 caracteres.', 'O nome deve ter no máximo 100 caracteres.']")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
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
