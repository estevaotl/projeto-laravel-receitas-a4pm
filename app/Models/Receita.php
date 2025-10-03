<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Usuario;

class Receita extends Model
{
    protected $table = 'receitas';

    protected $fillable = [
        'id_usuarios',
        'id_categorias',
        'nome',
        'tempo_preparo_minutos',
        'porcoes',
        'modo_preparo',
        'ingredientes',
        'criado_em',
        'alterado_em'
    ];

    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuarios');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categorias');
    }
}
