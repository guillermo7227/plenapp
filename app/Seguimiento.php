<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $guarded = [];


    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
