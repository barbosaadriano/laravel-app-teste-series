<?php

namespace App\Http\Controllers;

use App\Apontamento;
use Illuminate\Http\Request;

class ApontamentoController extends Controller
{

    public function create(Request $request)
    {
        $user = auth()->user();
        return view("apontamento.create",compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate(['codigo'=>'required']);
        $apontamento = new Apontamento();
        $apontamento->fill($request->all());
        $user = auth()->user();
        $apontamento->user()->associate($user);
        if (!$apontamento->save()) {
            return redirect()->back()->with("errors",["Não foi possível salvar o código!"]);
        }
        return view(
            "apontamento.create",
            [
                "mensagem"=>"Apontamento realizado para código {$apontamento->codigo}",
                "user" => $user,
            ]
        );
    }

}
