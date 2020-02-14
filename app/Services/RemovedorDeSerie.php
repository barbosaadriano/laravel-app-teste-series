<?php

namespace App\Services;

use App\{Serie,Temporada,Episodio};
use Illuminate\Support\Facades\DB;
class RemovedorDeSerie {

    public function removerSerie(int $serieId):string
    {
        $nomeSerie = '';
        DB::transaction(function() use (&$nomeSerie,$serieId){
            $serie = Serie::find($serieId);
            $nomeSerie = $serie->nome;            
            $this->removerTemporada($serie);
            $serie->delete();
        });         
        return $nomeSerie;
    }

    private function removerTemporada(Serie $serie)
    {
        $serie->temporadas->each(function(Temporada $temporada){            
            $this->removerEposodio($temporada);
            $temporada->delete();
        });
    }

    private function removerEposodio(Temporada $temporada)
    {
        $temporada->epsodios->each(function(Episodio $episodio){
            $episodio->delete();
        });
    }
}