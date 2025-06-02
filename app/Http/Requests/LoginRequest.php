<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'name' => 'required|string',
            'password' => 'required'

        ];
    }


    public function messages(){
        return[
            'name.required' => 'Nome do usuário é obrigatório!',
            'name.string' => 'Necessário enviar um nome valido!',
            'password.required' => 'Campo senha é necessário!'
        ];
    }
}
