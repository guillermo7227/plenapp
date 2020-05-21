<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $guarded = [];

    private $descuento;
    private $iva;
    private $manejo;

    public function __construct()
    {
        $this->descuento = LlaveValor::getDescuento();
        $this->iva = LlaveValor::getIva();
        $this->manejo = LlaveValor::getManejo();
    }

    private function getDescuento()
    {
        return $this->sin_descuento ? 0 : $this->precio_base * ($this->descuento / 100);
    }

    private function getBaseDescontada()
    {
        return $this->precio_base - $this->getDescuento();
    }

    private function getManejo()
    {
        return $this->precio_base * ($this->manejo / 100);
    }

    private function getBaseGravable()
    {
        return $this->getBaseDescontada() + $this->getManejo();
    }

    private function getIva()
    {
        return $this->sin_iva ? 0 : $this->getBaseGravable() * ($this->iva / 100);
    }

    public function getPrecioDistribuidorAttribute()
    {
        return $this->sin_descuento ? '' : $this->getBaseGravable() + $this->getIva();
    }

    public function getPrecioPublicoAttribute()
    {
        $this->descuento = 0;
        $result = $this->getBaseGravable() + $this->getIva();
        $this->descuento = LlaveValor::getDescuento();
        return round($result, -2);
    }

}
