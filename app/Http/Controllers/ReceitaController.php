<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $receitas = Receita::where('id_usuarios', $usuario->id)->get();
        $categorias = Categoria::all();

        return Inertia::render('Dashboard', [
            'auth' => ['user' => $usuario],
            'receitas' => $receitas,
            'categorias' => $categorias
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:45',
            'modo_preparo' => 'required|string',
            'ingredientes' => 'nullable|string',
            'tempo_preparo_minutos' => 'nullable|integer',
            'porcoes' => 'nullable|integer',
            'id_categorias' => 'nullable|exists:categorias,id'
        ]);

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

    public function update(Request $request, Receita $receita)
    {
        $this->authorize('update', $receita);

        $request->validate([
            'nome' => 'required|string|max:45',
            'modo_preparo' => 'required|string',
            'ingredientes' => 'nullable|string',
            'tempo_preparo_minutos' => 'nullable|integer',
            'porcoes' => 'nullable|integer',
            'id_categorias' => 'nullable|exists:categorias,id'
        ]);

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

        return Inertia::render('Imprimir', [
            'receita' => $receita
        ]);
    }
}
