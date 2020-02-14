<?php
namespace App\Services;
use App\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;

class CriadorDeSerie 
{
    
    public function criarSerie(string $nomeSerie,int $qtdTemporadas,int $epPorTemporada): Serie
    {
        
        DB::beginTransaction();
        $serie = Serie::create(['nome'=>$nomeSerie]);
        $this->criaTemporadas($qtdTemporadas,$epPorTemporada,$serie);  
        DB::commit();
        return $serie;
    }

    private function criaTemporadas(int $qtTemporadas, int $epPorTemporada, $serie) {
        for ($i=1;$i<=$qtTemporadas;$i++) {
            $this->criarTemporada($serie,$i,$epPorTemporada);
        }
    }

    private function criarTemporada(Serie $serie, int $numero, int $nEpisodios) : Temporada
    {
        $temporada = $serie->temporadas()->create(['numero'=>$numero]);
        for ($j=1;$j<=$nEpisodios;$j++) {
            $this->criarEpisodio($temporada,$j);
        }
        return $temporada;
    }

    private function criarEpisodio(Temporada $temporada,int $numero) : Episodio
    {
        return $temporada->epsodios()->create(['numero'=>$numero]);
    }

}

