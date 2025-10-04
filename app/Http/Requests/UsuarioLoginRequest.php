<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioLoginRequest extends FormRequest
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
            'login'    => 'required|string|max:100|min:2',
            'password' => 'required|string|max:100|min:2',
        ];
    }

    public function messages()
    {
        return [
            'login.required'    => 'Campo login é obrigatório',
            'login.min'         => 'Campo login deve ter no minimo :min caracteres',
            'login.max'         => 'Campo login deve ter no máximo :max caracteres',
            'password.required' => 'Campo senha é obrigatório',
            'password.min'      => 'Campo senha deve ter no minimo :min caracteres',
            'password.max'      => 'Campo senha deve ter no máximo :max caracteres',
        ];
    }
}
