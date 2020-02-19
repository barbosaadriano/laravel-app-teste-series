<?php

namespace App\Http\Controllers;

use App\Envite;
use App\Mail\EnviteCreated;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EnviteUserController extends Controller
{

    public function index()
    {
        return view('users.envite');
    }

    public function store(Request $request) {
        $email = $request->email;
        $envite = Envite::create([
            'email' => $email,
            'empresa_id' => session()->get('empresa')->id,
            'token' => base64_encode(Hash::make($email.time())),
        ]);
        $envite->created_at = new DateTime();
        $envite->save();
        Mail::to([
            'address'=>$email,
            'name'=>$email,
        ])->send(new EnviteCreated($envite));
        return view('users.envite',['mensagem'=>'Convite enviado!']);
    }

    public function aceitar(Request $request)
    {
        $token = $request->get('envite_token');
        if ($token === null) {
            abort(404,"Convite inválido!");
        }
        if ( Envite::query()
            ->where('token','=',$token)
            ->count() === 0 )
            {
                abort(404,"Convite não encontrado!");
            }
        return view('users.byenvite',compact('token'));
    }

}
