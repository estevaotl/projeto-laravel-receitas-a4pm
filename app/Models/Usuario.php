<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = ['nome', 'login', 'senha', 'criado_em', 'alterado_em'];

    public $timestamps = false;

    protected $hidden = ['senha'];

    public function getAuthIdentifierName()
    {
        return 'login';
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }
}
