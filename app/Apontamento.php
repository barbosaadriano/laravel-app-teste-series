<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apontamento extends Model
{
    protected $fillable = ['codigo'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
