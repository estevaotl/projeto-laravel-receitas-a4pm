<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioCadastroRequest extends FormRequest
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
            'nome' => 'required|string|min:2|max:100',
            'login' => 'required|string|unique:usuarios,login|min:2|max:100',
            'password' => 'required|string|min:2|max:100',
        ];
    }

    public function messages()
    {
        return [
            'nome.required'     => 'Campo nome é obrigatório',
            'nome.min'          => 'Campo nome deve ter no minimo :min caracteres',
            'nome.max'          => 'Campo nome deve ter no máximo :max caracteres',
            'login.required'    => 'Campo login é obrigatório',
            'login.min'         => 'Campo login deve ter no minimo :min caracteres',
            'login.max'         => 'Campo login deve ter no máximo :max caracteres',
            'login.unique'      => 'Já existe um usuario cadastrado com esse login',
            'password.required' => 'Campo password é obrigatório',
            'password.min'      => 'Campo password deve ter no minimo :min caracteres',
            'password.max'      => 'Campo password deve ter no máximo :max caracteres',
        ];
    }
}
