<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class CadastrarController extends Controller
{
    public function index(){
        return view('login.cadastrar');
    }

    public function cadastrarProcess(UserRequest $request){
        $valideted = $request->validated();
        $valideted['passsword'] = bcrypt($valideted['password']);

       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return to_route('login')->with('success', 'Usuário criado com sucesso!');

    }
}
