<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceitaRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Receita;
use App\Models\Categoria;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @OA\Info(
 *     title="A4PM Receitas API",
 *     version="1.0",
 *     description="Documentação da API de receitas e usuários"
 * )
 *
 * @OA\Tag(
 *     name="Receitas",
 *     description="Operações relacionadas às receitas"
 * )
 */
class ReceitaController extends Controller
{
    use AuthorizesRequests;

    /**
     * @OA\Get(
     *     path="/receitas/dashboard",
     *     summary="Lista todas as receitas do usuário autenticado",
     *     tags={"Receitas"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de receitas retornada com sucesso"
     *     )
     * )
     */
    public function index()
    {
        $usuario = Auth::user();

        $receitas = Receita::where('id_usuarios', $usuario->id)
            ->with('categoria') // carrega nome da categoria
            ->get();

        $categorias = Categoria::all();

        return Inertia::render('Receitas/Dashboard', [
            'auth' => ['user' => $usuario],
            'receitas' => $receitas,
            'categorias' => $categorias
        ]);
    }

    /**
     * @OA\Post(
     *     path="/receitas",
     *     summary="Cria uma nova receita",
     *     tags={"Receitas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome", "modo_preparo"},
     *             @OA\Property(property="nome", type="string"),
     *             @OA\Property(property="modo_preparo", type="string"),
     *             @OA\Property(property="ingredientes", type="string"),
     *             @OA\Property(property="tempo_preparo_minutos", type="integer"),
     *             @OA\Property(property="porcoes", type="integer"),
     *             @OA\Property(property="id_categorias", type="integer", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Receita criada com sucesso"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erros de validação",
     *            @OA\JsonContent(
     *              @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="nome", type="array",
     *                     @OA\Items(type="string", example="['Campo nome deve ter no máximo 100 caracteres.']")
     *                 ),
     *                 @OA\Property(property="id_categorias", type="array",
     *                     @OA\Items(type="string", example="['Não foi possivel cadastrar a receita com essa categoria selecionada, já que a categoria não existe.']")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(ReceitaRequest $request)
    {
        Receita::create([
            'id_usuarios' => Auth::id(),
            'id_categorias' => $request->id_categorias,
            'nome' => $request->nome,
            'modo_preparo' => $request->modo_preparo,
            'ingredientes' => $request->ingredientes,
            'tempo_preparo_minutos' => $request->tempo_preparo_minutos,
            'porcoes' => $request->porcoes,
            'criado_em' => Carbon::now(),
            'alterado_em' => Carbon::now()
        ]);

        return Inertia::location(route('receitas.dashboard'));
    }

    /**
     * @OA\Put(
     *     path="/receitas/{id}",
     *     summary="Atualiza uma receita existente",
     *     tags={"Receitas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da receita",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string"),
     *             @OA\Property(property="modo_preparo", type="string"),
     *             @OA\Property(property="ingredientes", type="string"),
     *             @OA\Property(property="tempo_preparo_minutos", type="integer"),
     *             @OA\Property(property="porcoes", type="integer"),
     *             @OA\Property(property="id_categorias", type="integer", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Receita atualizada com sucesso"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erros de validação",
     *            @OA\JsonContent(
     *              @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="nome", type="array",
     *                     @OA\Items(type="string", example="['Campo nome deve ter no máximo 100 caracteres.']")
     *                 ),
     *                 @OA\Property(property="id_categorias", type="array",
     *                     @OA\Items(type="string", example="['Não foi possivel cadastrar a receita com essa categoria selecionada, já que a categoria não existe.']")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function update(ReceitaRequest $request, Receita $receita)
    {
        $this->authorize('update', $receita);

        $receita->update([
            'id_categorias' => $request->id_categorias,
            'nome' => $request->nome,
            'modo_preparo' => $request->modo_preparo,
            'ingredientes' => $request->ingredientes,
            'tempo_preparo_minutos' => $request->tempo_preparo_minutos,
            'porcoes' => $request->porcoes,
            'alterado_em' => Carbon::now()
        ]);

        return Inertia::location(route('receitas.dashboard'));
    }

    /**
     * @OA\Delete(
     *     path="/receitas/{id}",
     *     summary="Exclui uma receita",
     *     tags={"Receitas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da receita",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Receita excluída com sucesso"
     *     )
     * )
     */
    public function destroy(Receita $receita)
    {
        $this->authorize('delete', $receita);

        $receita->delete();

        return Inertia::location(route('receitas.dashboard'));
    }

    /**
     * @OA\Get(
     *     path="/receitas/{id}/imprimir",
     *     summary="Renderiza a receita para impressão",
     *     tags={"Receitas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da receita",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Receita pronta para impressão"
     *     )
     * )
     */
    public function imprimir(Receita $receita)
    {
        $this->authorize('view', $receita);

        $receita->load('categoria');

        return Inertia::render('Imprimir', [
            'receita' => $receita
        ]);
    }
}
