<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\User;

class EmpresaController extends Controller
{
    public function index(){
        $empresas = Empresa::orderByDesc('id')->paginate(2);
        return view('empresas.index',['empresas' => $empresas]);
    }

    public function show(Empresa $empresa){
        $empresa->loadCount('usuarios');
        return view('empresas.show',['empresa' => $empresa]);
    }

    public function create(){
        return view('empresas.create');
    }


    public function store(EmpresaRequest $request){

        Empresa::create([
            'name' => $request->name,
            'cnpj' => $request->cnpj,
            'email' => $request->email
        ]);

        return to_route('empresa.index')->with(['message' => 'Empresa cadastrada com sucesso!']);
        
    }

    public function edit(Empresa $empresa){
        return view('empresas.edit',['empresa' => $empresa]);
    }

    public function update(Empresa $empresa, EmpresaRequest $request){
        $request->validated();
        
        $dadosAtualizados=([
            'name' => $request->name,
            'email' => $request->email,
            'cnpj' => $request->cnpj,
        ]);

        if (
            $empresa->name === $dadosAtualizados['name'] &&
            $empresa->email === $dadosAtualizados['email'] &&
            $empresa->cnpj === $dadosAtualizados['cnpj']
        ) {
            return redirect()
                ->route('empresa.show', $empresa->id)
                ->with('info', 'Nenhuma alteração foi feita nos dados da empresa.');
        }
        
        $empresa->update($dadosAtualizados);

        return to_route('empresa.show', ['empresa' => $empresa->id])->with('success', 'Empresa alterada com sucesso.');
    }

    public function prossEmpre(){
        
        return view('empresas.empres-usuario');
    }

    public function cadastraUsuarioEmpresa(Request $request, Empresa $empresa){
        
        if(!isset($empresa)){
            return back()->with('error', 'Não há empresa disponivel no momento');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'empresa_id' => 'required|exists:empresas,id',
        ],[
            'user_id.required' => 'Não há usuário selecionado',
            'empresa_id.exists' => 'A empresa selecionada é inválida ou não está cadastrada.',
            'empresa_id.required' => 'A seleção de uma empressa é obrigatório'
        ]);
    
        $user = User::find($request->user_id);

        if($user->empresa){
            return back()->with('error', 'Este usuário já está vinculado a uma empresa.');
        }

        $user->empresa_id = $request->empresa_id;
        $user->save();
    
        return redirect()->back()->with('success', 'Usuário vinculado à empresa com sucesso!');
    }
    

    public function destroy(Empresa $empresa){
        $empresa->delete();
        
        return to_route('empresa.index')->with('success', 'Empresa removido com sucesso');
    }

}
