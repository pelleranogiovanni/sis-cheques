<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'nombre',
        'cuit',
        'domicilio',
        'telefono',
        'email'
    ];

    public function checks()
    {
        return $this->hasMany('App\Check');
    }
}
