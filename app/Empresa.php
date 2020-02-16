<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{

    protected $fillable = ['nome','user_id'];

    public function administrador()
    {
        return $this->belongsTo(User::class,"user_id");
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
