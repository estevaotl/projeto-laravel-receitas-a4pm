<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::factory()->create([
            'nome' => 'João',
            'login' => 'joao',
            'senha' => Hash::make('senha123'),
            'criado_em' => now(),
            'alterado_em' => now(),
        ]);
    }
}
