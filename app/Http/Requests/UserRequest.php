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
            'name' => ['required',  'string', 'max:255', 'unique:users,name'],
            'email' => 'email | unique:users,email,' . ($userId ? $userId->id : null) . ',id',
            'password' => [$this->isMethod('post') ? 'required' : 'sometimes|',
                            'confirmed',
                            'nullable',
                            'min:6']
        ];
    }

    public function messages(){
        return [
            'name.unique' => 'Nome de usuário já em uso!',
            'name.required' => 'O campo nome é obrigatório!',
            'email.required' => 'O campo email é obrigatório!',
            'email.unique' => 'Email já está sendo utilizado.',
            'email.email' => 'Necessário um email válidor!',
            'password.required' => 'O campo senha é obrigatório!',
            'password.confirmed' => 'A confirmação de senha não corresponde!',
            'password.min' => 'A senha tem que conter no mínimo 6 caracteres!'
        ];
    }
}
