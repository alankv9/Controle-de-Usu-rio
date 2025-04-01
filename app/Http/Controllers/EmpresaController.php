<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index(){
        $empresas = Empresa::orderByDesc('id')->paginate(2);
        return view('empresas.index',['empresas' => $empresas]);
    }

    public function show(Empresa $empresa){
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

        $empresa->update([
            'name' => $request->name,
            'email' => $request->email,
            'cnpj' => $request->cnpj,
        ]);

        return to_route('empresa.show', ['empresa' => $empresa->id])->with('success', 'Empresa alterada com sucesso.');
    }

    public function destroy(Empresa $empresa){
        $empresa->delete();
        
        return to_route('empresa.index')->with('success', 'Empresa removido com sucesso');
    }

}
