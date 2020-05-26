<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medio extends Model
{
    protected $guarded = [];

    protected $with = ['etiquetas'];

    protected $appends = ['ruta'];

    public function getRutaAttribute()
    {
        return secure_asset('storage/medios/'.$this->nombre_archivo);
    }

    public function getMiniaturaAttribute()
    {
        $fullName = $this->nombre_archivo;
        $name = str_replace(substr($fullName, strpos($fullName,'.')), '', $fullName);
        return secure_asset('storage/medios/miniaturas/'.$name.'.jpeg');
    }

    public function etiquetas()
    {
        return $this->belongsToMany(Etiqueta::class);
    }
}
