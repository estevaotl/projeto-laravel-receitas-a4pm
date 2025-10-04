<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceitaRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Receita;
use App\Models\Categoria;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReceitaController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $usuario = Auth::user();

        $receitas = Receita::where('id_usuarios', $usuario->id)
            ->with('categoria') // carrega nome da categoria
            ->get();

        $categorias = Categoria::all();

        return Inertia::render('Dashboard', [
            'auth' => ['user' => $usuario],
            'receitas' => $receitas,
            'categorias' => $categorias
        ]);
    }

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

        return redirect()->route('dashboard');
    }

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

        return redirect()->route('dashboard');
    }

    public function destroy(Receita $receita)
    {
        $this->authorize('delete', $receita);

        $receita->delete();

        return redirect()->route('dashboard');
    }

    public function imprimir(Receita $receita)
    {
        $this->authorize('view', $receita);

        $receita->load('categoria'); // carrega nome da categoria

        return Inertia::render('Imprimir', [
            'receita' => $receita
        ]);
    }
}
