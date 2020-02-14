<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Temporada extends Model
{
    
    protected $fillable = ['numero'];
    public $timestamps = false;
    
    function epsodios()
    {
        return $this->hasMany(Episodio::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function getEpisodiosAssistidos():Collection
    {
        return $this->epsodios->filter(function(Episodio $episodio){
            return $episodio->assistido;
        });
    }
}
