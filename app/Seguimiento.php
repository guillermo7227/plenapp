<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $guarded = [];

    protected $with = ['cliente'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
