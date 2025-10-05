<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceitaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'string|max:45',
            'modo_preparo' => 'required|string',
            'ingredientes' => 'nullable|string',
            'tempo_preparo_minutos' => 'nullable|integer',
            'porcoes' => 'nullable|integer',
            'id_categorias' => 'nullable|exists:categorias,id'
        ];
    }

    public function messages()
    {
        return [
            'id_categorias.exists' => 'Não foi possivel cadastrar a receita com essa categoria selecionada, já que a categoria não existe',
            'nome.max'             => 'Campo nome deve ter no máximo :max caracteres'
        ];
    }
}
