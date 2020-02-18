<?php

namespace App\Http\Controllers;

use App\Apontamento;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function index(Request $request)
    {
        $useid = $request->user_id ? $request->user_id : auth()->user()->id;
        $nome = User::find($useid)->name;
        $apontamentos = Apontamento::query()
                            ->where("user_id","=",$useid)
                            ->orderBy('created_at','desc')
                            ->paginate(10);
        return view('apontamento.index',[
            'apontamentos' => $apontamentos,
            'nome' => $nome,
        ]);
    }

    public function exportar(User $usuario,string $tipo,Request $request)
    {
        $qry = Apontamento::query();
        $qry->where("user_id","=",$usuario->id);
        if ($tipo=="nao_exportados") {
            $qry->where('exportado','=',false);
        }
        $apontamentos = $qry->get();
        if ($apontamentos->count()===0) {
            return back()->withErrors(["Não há nenhum registro sem exportar, se quer exportar novamente, tente exportar todos!"]);
        }
        DB::beginTransaction();

        $filename = "files/filecsv.csv";
        $handle = fopen($filename,'w+');
        try {
            fputcsv($handle,['codigo','momento','usuario'],";");
            foreach ($apontamentos as $ap) {
                fputcsv($handle, [
                    $ap->codigo,
                    $ap->created_at,
                    $ap->user->name,
                ], ";");
                $ap->exportado = true;
                $ap->save();
            }
            fclose($handle);
            DB::commit();
        } catch(Exception $e) {
            DB::rollback();
            throw $e;
        }
        $headers = [
            'Content-Type' => 'text/csv',
        ];
        return response()->download($filename,'file '.date('d-m-Y H:i:s').'.csv',$headers);
    }

}
