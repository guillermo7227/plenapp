<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $guarded = [];


    public function seguimiento()
    {
        return $this->hasOne(Seguimiento::class);
    }
}
