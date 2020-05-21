<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LlaveValor extends Model
{
    protected $guarded = [];


    public static function porLlave(string $llave)
    {
        return static::where('llave', $llave)->firstOrFail();
    }

    public static function getDescuento()
    {
        return (integer)static::where('llave', 'descuento')->firstOrFail()->valor;
    }

    public static function getIva()
    {
        return (integer)static::where('llave', 'iva')->firstOrFail()->valor;
    }

    public static function getManejo()
    {
        return (integer)static::where('llave', 'manejo')->firstOrFail()->valor;
    }
}
