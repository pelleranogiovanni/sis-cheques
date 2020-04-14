<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }
}
