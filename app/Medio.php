<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medio extends Model
{
    protected $guarded = [];


    public function getRutaAttribute()
    {
        return asset('storage/medios/'.$this->nombre_archivo);
    }
}
