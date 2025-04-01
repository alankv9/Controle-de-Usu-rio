<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'cnpj' => 'required|string|size:14|unique:empresas,cnpj',
            'email' => 'required|email|unique:empresas,email',
        ];
    }

    /**
     * Customiza as mensagens de erro.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome da empresa é obrigatório.',
            'name.string' => 'O nome deve ser um texto válido.',
            'name.max' => 'O nome pode ter no máximo 255 caracteres.',

            'cnpj.required' => 'O CNPJ é obrigatório.',
            'cnpj.string' => 'O CNPJ deve ser uma string.',
            'cnpj.size' => 'O CNPJ deve ter exatamente 14 caracteres.',
            'cnpj.unique' => 'Este CNPJ já está cadastrado.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço válido.',
            'email.unique' => 'Este e-mail já está cadastrado em uma empresa.',
        ];
    }
}
