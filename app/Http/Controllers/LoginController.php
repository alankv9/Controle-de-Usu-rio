<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.users');
    }

    public function loginProcess(LoginRequest $request)
    {
        // $validated = $request->validated();
        // $validated['password'] = bcrypt($validated['password']);

        // if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        //     return back()->withInput()->with('error', 'E-mail ou senha inválido!');
        // }

        // $user = Auth::user(); // Usuário autenticado

        // return redirect()->route('user.index');
        if(!Auth::attempt($request->only(['email', 'password']))){
            return redirect()->back()->withErrors('Usuário ou senha inválidos');
        }
    
        return to_route('users.index');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
