<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        $users = User::orderByDesc('id')->paginate(2);
        return view('users.index', ['users' => $users]);
    }

    public function show(User $user){
        
        return view('users.show', ['user' => $user]);
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
            'password' => Hash::make($request->password),
        ]);
        return to_route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user){

        return view('users.edit',['user' => $user]);
    }

    public function update(UserRequest $request, User $user ){
        $request->validated();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if($request->filled('password')){
            $data['password'] = Hash::make($request->password);
        }
        
        $user->update($data);

        return to_route('users.show',['user' => $user->id])->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function destroy(User $user){
        $user->delete();
        return to_route('users.index')->with('success', 'Usuário removido com sucesso');
    }
}
