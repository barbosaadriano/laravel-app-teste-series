<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envite extends Model
{

    public $timestamps = false;

    protected $fillable = ["empresa_id","email","token"];

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }
}
