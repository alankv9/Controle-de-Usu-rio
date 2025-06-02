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

        if(!Auth::attempt($request->only(['name', 'password']))){
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
