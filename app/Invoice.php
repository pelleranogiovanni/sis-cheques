<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function check()
    {
        return $this->belongsTo('App\Check');
    }
}
