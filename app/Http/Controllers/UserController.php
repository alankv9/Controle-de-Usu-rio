<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Empresa;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){

        $users = User::orderByDesc('id')->paginate(2);
        return view('users.index', ['users' => $users]);
    }

    public function show(User $user){
        
        return view('users.show', [
            'user' => $user,
            'empresa' => $user->empresa]);
    }

    public function create(Request $request){

        return view('users.create');
    }

    public function store(UserRequest $request){
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return to_route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user){

        return view('users.edit',['user' => $user]);
    }

    public function update(User $user, UserRequest $request){
        $request->validated();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if($request->filled('password')){
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }
        
        return to_route('users.show',['user' => $user->id])->with('success', 'Usuário alterado com sucesso!');
    }

    public function destroy(User $user){
        $user->delete();
        return to_route('users.index')->with('success', 'Usuário removido com sucesso');
    }
}
