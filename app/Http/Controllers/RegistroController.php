<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Envite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    public function create()
    {
        return view('registro.create');
    }

    public function store(Request $request)
    {

        //dd($request->all());
        DB::beginTransaction();
        $data = $request->except(['_token', 'nomeEmpresa','envite_token']);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        if ($request->has('envite_token')) {
            $envite = Envite::query()
            ->where('token','=',$request->get('envite_token'))->get()[0];
            if ($envite->email !== $data['email']) {
                abort(404,"Este convite é para outro e-mail!");
            }
            $empresa = $envite->empresa;
            $user->empresa()->associate($empresa);
            $user->save();
            session()->put('empresa', $empresa);
            Auth::login($user);
        } else {
            $nomeEmpresa = $request->get('nomeEmpresa');
            $empresa = Empresa::create(['nome' => $nomeEmpresa, 'user_id' => $user->id]);
            session()->put('empresa', $empresa);
            Auth::login($user);
        }
        DB::commit();
        return redirect()->route('home');
    }
}
