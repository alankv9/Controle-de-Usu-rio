<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function store(UserRequest $request)
    {
        $validated = $request->validated();
    
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/images', 'public');
        }
    
        $validated['password'] = Hash::make($validated['password']);
        $validated['photo'] = $photoPath;
    
        User::create($validated);
    
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
