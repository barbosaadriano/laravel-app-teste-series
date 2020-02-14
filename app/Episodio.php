<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    protected $fillable = ['numero'];
    public $timestamps = false;
    
    function temporada()
    {
        return $this->belongsTo(Temporada::class);
    }

}
