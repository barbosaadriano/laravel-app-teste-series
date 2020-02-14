<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temporada;
use App\Episodio;

class EpisodiosController extends Controller
{
    public function index(Temporada $temporada,Request $request)
    {
        $episodios = $temporada->epsodios;
        $temporadaId = $temporada->id;
        $mensagem = $request->session()->get('mensagem');
        return view('episodios.index',compact('episodios','temporadaId','mensagem'));
    }
    public function assistir(Temporada $temporada, Request $request)
    {
        $episodiosAssistidos = $request->episodios;
        $temporada->epsodios->each(function(Episodio $episodio) use ($episodiosAssistidos){
            $episodio->assistido = in_array($episodio->id,$episodiosAssistidos);
        });
        $temporada->push();
        $request->session()->flash('mensagem','Episódios marcados como assistidos');
        return redirect()->back();
    }
}
