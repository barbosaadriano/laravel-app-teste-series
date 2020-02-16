<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apontamento extends Model
{
    protected $fillable = ['codigo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
