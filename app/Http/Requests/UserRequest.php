<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $userId = $this->route('users');
        return [
            'name' => 'required | string | max:255',
            'E-mail' => 'email | unique:user,email,' . ($userId ? $userId->id : null) . ',id',
            'password' => $this->isMethod('post') ? 'required|min:6' : 'sometimes| confirmation |nullable|min:6'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'O campo nome é obrigatório!',
            'E-mail.required' => 'O campo email é obrigatório!',
            'E-mail.email' => 'Necessário um email válidor!',
            'password.required' => 'O campo senha é obrigatório!',
            'password.confirmation' => 'A confirmação de senha não corresponde!',
            'password.min' => 'A senha tem que conter no mínimo 6 caracteres!'
        ];
    }
}
