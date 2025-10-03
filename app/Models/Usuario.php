<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';

    protected $fillable = ['nome', 'login', 'senha', 'criado_em', 'alterado_em'];

    public $timestamps = false;

    protected $hidden = ['senha'];

    public function getAuthPassword()
    {
        return $this->senha;
    }
}
