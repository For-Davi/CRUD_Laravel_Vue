<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Transportadora;
use App\Http\Controllers\Controller;

class TransportadoraController extends Controller
{
    //  Listar transportadoras
     public function index(){
        // return 'TESTANDO INDEX';
        $transportadoras = Transportadora::all()->toArray();
        return array_reverse($transportadoras);
    }
    

    // Adicionar transportadoras
    public function add(Request $request)
    {
        $transportadoras = new Transportadora([
            'nome' => $request->nome,
            'endereco' => $request->endereco,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
            'limite_credito' => $request->limite_credito,
            'data_analise_credito' => $request->data_analise_credito,
        ]);
        $transportadoras->save();

        return response()->json('A transportadora foi cadastrada com sucesso!');
    }

    // Editar transportadora
    public function edit($id)
    {
        $transportadora= Transportadora::find($id);
        return response()->json($transportadora);
    }

    // Atualizar transportadora
    public function update($id, Request $request)
    {
        $transportadora = Transportadora::find($id);
        $transportadora->update($request->all());

        return response()->json('A transportadora foi atualizada com sucesso!');
    }

    // Deletar transportadora
    public function delete($id)
    {
        $transportadora = Transportadora::find($id);
        $transportadora->delete();

        return response()->json('A transportadora foi deletada com sucesso!');
    }
}
